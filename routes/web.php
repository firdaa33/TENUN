<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ProductController,
    CartController,
    CheckoutController,
    AboutController,
    OrderController,
    InvoiceUserController,
    PaymentController,
    ProfileController,
    ReturnController,
    RatingController
};
use App\Http\Controllers\Auth\{
    RegisterController,
    LoginController,
    RegisteredUserController
};
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Admin\{
    DashboardController,
    InvoiceController
};

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::view('/', 'pages.home')->name('home');
Route::get('/', HomeController::class)->name('home');
Route::get('/about', AboutController::class)->name('about');
Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::get('/produk/{product:slug}', [ProductController::class, 'show'])->name('produk.show');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/rating', [RatingController::class, 'index'])->name('rating.index');
/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart-clear', [CartController::class, 'clear'])->name('cart.clear');

/*
|--------------------------------------------------------------------------
| USER (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.process');

    // Alamat
    Route::get('/alamat/edit', [RegisteredUserController::class, 'editAlamat'])->name('alamat.edit');
    Route::post('/alamat/update', [RegisteredUserController::class, 'updateAlamat'])->name('alamat.update');
    Route::get('/checkout/ubah-alamat', [CheckoutController::class, 'editAlamat'])->name('checkout.ubah-alamat');
    Route::post('/checkout/ubah-alamat', [CheckoutController::class, 'updateAlamat'])->name('checkout.update-alamat');

    // Orders
    //Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    //Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');

    Route::put('/orders/{order}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::put('/orders/{order}/user-confirm', [OrderController::class, 'userConfirm'])->name('orders.user-confirm');
    Route::post('/orders/{order}/upload', [OrderController::class, 'uploadBukti'])->name('orders.upload');
    Route::post('/orders/{order}/upload-bukti', [OrderController::class, 'uploadBukti'])->name('orders.uploadBukti');
    Route::post('/orders/{order}/payment', [PaymentController::class, 'uploadProof'])->name('payments.upload');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'showInvoice'])->name('orders.invoice');
    Route::get('/pesanan/{order}/invoice', [InvoiceUserController::class, 'show'])->name('user.invoice');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    //rate
    Route::get('/produk/{id}/rating', [RatingController::class, 'create'])->name('produk.rating.create');
    Route::post('/produk/rating', [RatingController::class, 'store'])->name('produk.rating.store');
    Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Return / Pengembalian
    Route::get('/returns/{order}/create', [ReturnController::class, 'create'])->name('returns.create');
    Route::post('/returns', [ReturnController::class, 'store'])->name('returns.store');
    Route::post('/returns/{order}', [ReturnController::class, 'store'])->name('returns.store');

    Route::get('/contact', function () {
        return view('pages.contact'); // atau sesuai struktur kamu
    })->name('contact');

});

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect('/checkout');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login']);
    });

    // Authenticated Admin
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Invoice
        Route::get('/invoice/{order}', [InvoiceController::class, 'show'])->name('invoice');
        Route::get('/invoice/{order}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoice.pdf');
        Route::get('/invoice/{order}/download', [InvoiceController::class, 'download'])->name('invoice.download');
    });
});
