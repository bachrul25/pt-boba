<?php

use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminLoginComponent;
use App\Livewire\Admin\ManageCompanyStructureComponent;
use App\Livewire\Admin\ManageProductsComponent as AdminManageProductsComponent;
use App\Livewire\Admin\ManageSellersComponent;
use App\Livewire\Admin\ManageServicesComponent as AdminManageServicesComponent;
use App\Livewire\Admin\ViewReportsComponent as AdminViewReportsComponent;
use App\Livewire\Auth\LoginComponent;
use App\Livewire\Auth\RegisterComponent;
use App\Livewire\Buyer\BuyerDashboardComponent;
use App\Livewire\Buyer\CartComponent;
use App\Livewire\Buyer\CheckoutComponent;
use App\Livewire\Buyer\ProductDetailComponent;
use App\Livewire\Buyer\ProductListComponent;
use App\Livewire\Buyer\ServiceBookingComponent;
use App\Livewire\Buyer\ServiceListComponent;
use App\Livewire\Buyer\ServiceTrackingComponent;
use App\Livewire\HomePageComponent;
use App\Livewire\LandingPageComponent;
use App\Livewire\Seller\ManageProductsComponent as SellerManageProductsComponent;
use App\Livewire\Seller\ManageServicesComponent as SellerManageServicesComponent;
use App\Livewire\Seller\SellerDashboardComponent;
use App\Livewire\Seller\SellerProfileComponent;
use App\Livewire\Seller\SellerRegisterComponent;
use App\Livewire\Seller\ViewReportsComponent as SellerViewReportsComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', LandingPageComponent::class)->name('landing');
Route::get('/home', HomePageComponent::class)->name('home');

// Auth (guest)
Route::get('/login', LoginComponent::class)->name('login');
Route::get('/register', RegisterComponent::class)->name('register');
Route::get('/seller/register', SellerRegisterComponent::class)->name('seller.register');
Route::get('/admin/login', AdminLoginComponent::class)->name('admin.login');

// Logout
Route::match(['get', 'post'], '/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/company-structure', ManageCompanyStructureComponent::class)->name('admin.company-structure');
    Route::get('/sellers', ManageSellersComponent::class)->name('admin.sellers');
    Route::get('/products', AdminManageProductsComponent::class)->name('admin.products');
    Route::get('/services', AdminManageServicesComponent::class)->name('admin.services');
    Route::get('/reports', AdminViewReportsComponent::class)->name('admin.reports');
});

// Buyer routes
Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->group(function () {
    Route::get('/dashboard', BuyerDashboardComponent::class)->name('buyer.dashboard');
    Route::get('/products', ProductListComponent::class)->name('buyer.products');
    Route::get('/products/{id}', ProductDetailComponent::class)->name('buyer.product.detail');
    Route::get('/cart', CartComponent::class)->name('buyer.cart');
    Route::get('/checkout', CheckoutComponent::class)->name('buyer.checkout');
    Route::get('/services', ServiceListComponent::class)->name('buyer.services');
    Route::get('/services/{id}/booking', ServiceBookingComponent::class)->name('buyer.service.booking');
    Route::get('/service-tracking/{id?}', ServiceTrackingComponent::class)->name('buyer.service.tracking');
});

// Seller routes
Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {
    Route::get('/dashboard', SellerDashboardComponent::class)->name('seller.dashboard');
    Route::get('/profile', SellerProfileComponent::class)->name('seller.profile');
    Route::get('/products', SellerManageProductsComponent::class)->name('seller.products');
    Route::get('/services', SellerManageServicesComponent::class)->name('seller.services');
    Route::get('/reports', SellerViewReportsComponent::class)->name('seller.reports');
});
