<?php

use App\Livewire\Admin;
use App\Livewire\Auth\LoginComponent;
use App\Livewire\Auth\RegisterBuyerComponent;
use App\Livewire\Auth\RegisterSellerComponent;
use App\Livewire\Auth\RoleSelectComponent;
use App\Livewire\Buyer;
use App\Livewire\HomePageComponent;
use App\Livewire\InvestorRelationsComponent;
use App\Livewire\LandingPageComponent;
use App\Livewire\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PT BOBA Web Routes — semua route langsung ke Livewire Component (tanpa Controller)
|--------------------------------------------------------------------------
*/

// Public pages
Route::get('/', LandingPageComponent::class)->name('landing');
Route::get('/home', HomePageComponent::class)->name('home');
Route::get('/investor-relations', InvestorRelationsComponent::class)->name('investor');

// Auth (manual via Livewire components, no Controllers)
Route::middleware('guest')->group(function () {
    Route::get('/login', LoginComponent::class)->name('login');
    Route::get('/register', RoleSelectComponent::class)->name('register');
    Route::get('/register/buyer', RegisterBuyerComponent::class)->name('register.buyer');
    Route::get('/register/seller', RegisterSellerComponent::class)->name('register.seller');
});

// Logout via inline closure (still no controller class)
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Authenticated dashboard router
Route::middleware('auth')->get('/dashboard', function () {
    $u = Auth::user();

    return match ($u->role) {
        'admin' => redirect('/admin'),
        'seller' => redirect('/seller'),
        default => redirect('/buyer'),
    };
})->name('dashboard');

// Admin (role enforced inside each component via mount())
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', Admin\DashboardComponent::class)->name('admin.dashboard');
    Route::get('/founders', Admin\ManageFoundersComponent::class)->name('admin.founders');
    Route::get('/brands', Admin\ManageBrandsComponent::class)->name('admin.brands');
    Route::get('/products', Admin\ManageProductsComponent::class)->name('admin.products');
    Route::get('/services', Admin\ManageServicesComponent::class)->name('admin.services');
    Route::get('/sellers', Admin\ManageSellersComponent::class)->name('admin.sellers');
    Route::get('/orders', Admin\ManageOrdersComponent::class)->name('admin.orders');
    Route::get('/investor-inquiries', Admin\ManageInvestorInquiriesComponent::class)->name('admin.investor');
    Route::get('/documents', Admin\ManageCompanyDocumentsComponent::class)->name('admin.documents');
    Route::get('/milestones', Admin\ManageMilestonesComponent::class)->name('admin.milestones');
    Route::get('/impact-metrics', Admin\ManageImpactMetricsComponent::class)->name('admin.metrics');
    Route::get('/bmc', Admin\BmcComponent::class)->name('admin.bmc');
});

// Buyer (role enforced inside each component via mount())
Route::middleware(['auth'])->prefix('buyer')->group(function () {
    Route::get('/', Buyer\DashboardComponent::class)->name('buyer.dashboard');
    Route::get('/browse', Buyer\BrowseComponent::class)->name('buyer.browse');
    Route::get('/services', Buyer\ServicesComponent::class)->name('buyer.services');
    Route::get('/orders', Buyer\OrdersComponent::class)->name('buyer.orders');
    Route::get('/service-requests', Buyer\ServiceRequestsComponent::class)->name('buyer.requests');
});

// Seller (role enforced inside each component via mount())
Route::middleware(['auth'])->prefix('seller')->group(function () {
    Route::get('/', Seller\DashboardComponent::class)->name('seller.dashboard');
    Route::get('/products', Seller\ProductsComponent::class)->name('seller.products');
    Route::get('/services', Seller\ServicesComponent::class)->name('seller.services');
    Route::get('/orders', Seller\OrdersComponent::class)->name('seller.orders');
});
