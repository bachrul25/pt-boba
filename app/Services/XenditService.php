<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ServiceRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\Invoice;
use Xendit\Invoice\InvoiceApi;

class XenditService
{
    /**
     * Build a Xendit invoice for an Order or ServiceRequest and return
     * the persisted invoice URL/id. The model is updated in place.
     *
     * @param  Order|ServiceRequest  $payable
     */
    public function createInvoiceFor(Model $payable): string
    {
        $secret = (string) config('services.xendit.secret_key');
        if ($secret === '') {
            throw new RuntimeException('XENDIT_SECRET_KEY belum dikonfigurasi. Lihat INSTALL.md.');
        }

        Configuration::setXenditKey($secret);

        [$externalId, $amount, $description, $payerEmail] = $this->describePayable($payable);

        $appUrl = rtrim((string) config('app.url'), '/');
        $request = new CreateInvoiceRequest([
            'external_id' => $externalId,
            'amount' => (float) $amount,
            'description' => $description,
            'currency' => 'IDR',
            'invoice_duration' => (int) config('services.xendit.invoice_duration', 86400),
            'success_redirect_url' => config('services.xendit.success_redirect_url') ?: ($appUrl.$this->successPath($payable)),
            'failure_redirect_url' => config('services.xendit.failure_redirect_url') ?: ($appUrl.$this->successPath($payable)),
            'customer' => $payerEmail !== null ? ['email' => $payerEmail] : null,
        ]);

        $api = new InvoiceApi;
        /** @var Invoice $invoice */
        $invoice = $api->createInvoice($request);

        $payable->forceFill([
            'payment_provider' => 'xendit',
            'payment_external_id' => $externalId,
            'payment_invoice_id' => $invoice->getId(),
            'payment_status' => $invoice->getStatus() ?: 'PENDING',
            'payment_url' => $invoice->getInvoiceUrl(),
        ])->save();

        return (string) $invoice->getInvoiceUrl();
    }

    /**
     * Verify Xendit callback token (sent in `x-callback-token` header).
     */
    public function verifyCallbackToken(?string $incoming): bool
    {
        $expected = (string) config('services.xendit.callback_token');
        if ($expected === '' || $incoming === null || $incoming === '') {
            return false;
        }

        return hash_equals($expected, $incoming);
    }

    /**
     * Apply the result of an invoice webhook payload to the matching
     * Order or ServiceRequest. Returns the updated model or null when
     * no matching record is found.
     */
    public function applyInvoiceCallback(array $payload): ?Model
    {
        $externalId = $payload['external_id'] ?? null;
        $invoiceId = $payload['id'] ?? null;
        $status = strtoupper((string) ($payload['status'] ?? 'PENDING'));
        if (! is_string($externalId) || $externalId === '') {
            return null;
        }

        $payable = $this->resolveByExternalId($externalId);
        if ($payable === null) {
            Log::warning('Xendit callback: no matching record', ['external_id' => $externalId]);

            return null;
        }

        $update = [
            'payment_status' => $status,
            'payment_invoice_id' => $invoiceId ?: $payable->payment_invoice_id,
        ];

        if ($status === 'PAID' || $status === 'SETTLED') {
            $update['paid_at'] = now();
            if ($payable instanceof Order && $payable->status === 'pending') {
                $update['status'] = 'paid';
            }
            if ($payable instanceof ServiceRequest && $payable->status === 'pending') {
                $update['status'] = 'confirmed';
            }
        }

        $payable->forceFill($update)->save();

        return $payable;
    }

    /**
     * @return array{0:string,1:float,2:string,3:?string}
     */
    protected function describePayable(Model $payable): array
    {
        if ($payable instanceof Order) {
            $email = $payable->buyer?->email;

            return [
                'order-'.$payable->order_number,
                (float) $payable->total,
                'Pembayaran Order PT BOBA #'.$payable->order_number,
                $email,
            ];
        }

        if ($payable instanceof ServiceRequest) {
            $email = $payable->buyer?->email;

            return [
                'svc-'.$payable->request_number,
                (float) $payable->estimated_price,
                'Pembayaran Layanan Green Services #'.$payable->request_number,
                $email,
            ];
        }

        throw new RuntimeException('Unsupported payable type: '.get_class($payable));
    }

    protected function successPath(Model $payable): string
    {
        return $payable instanceof ServiceRequest ? '/buyer/service-requests' : '/buyer/orders';
    }

    protected function resolveByExternalId(string $externalId): ?Model
    {
        if (str_starts_with($externalId, 'order-')) {
            return Order::where('order_number', substr($externalId, 6))->first();
        }
        if (str_starts_with($externalId, 'svc-')) {
            return ServiceRequest::where('request_number', substr($externalId, 4))->first();
        }

        return Order::where('payment_external_id', $externalId)->first()
            ?? ServiceRequest::where('payment_external_id', $externalId)->first();
    }
}
