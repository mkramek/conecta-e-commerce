<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Blog\Post;
use App\Livewire\Blog\Posts;
use App\Livewire\Customer\Cart;
use App\Livewire\Customer\Cash;
use App\Livewire\Customer\Checkout;
use App\Livewire\Customer\Contact;
use App\Livewire\Customer\Custom;
use App\Livewire\Customer\FedEx;
use App\Livewire\Customer\Payment;
use App\Livewire\Customer\PayU;
use App\Livewire\Customer\Transfer;
use App\Livewire\Customer\UPS;
use App\Livewire\Legal\PrivacyPolicy;
use App\Livewire\Legal\Terms;
use App\Livewire\Newsletter\SignUp;
use App\Livewire\Product\Listing;
use App\Livewire\Product\Search;
use App\Livewire\Product\Single;
use App\Livewire\Profile\B2B;
use App\Livewire\Profile\Orders;
use App\Livewire\Profile\ViewProfile;
use App\Livewire\Public\Home;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$lang = App::getLocale();

Route::redirect('/', "/$lang");

Route::get("/$lang/login", Login::class)->name('login');

foreach (config('lang.available_languages') as $lang) {
    Route::prefix($lang)->group(function () use ($lang) {
        Route::get('/', Home::class)->name("home.$lang");
        Route::get('login', Login::class)->name("login.$lang");

        Route::get('register', Register::class)->name("register.$lang");

        Route::get('blog', Posts::class)->name("blog.$lang");

        Route::get('blog/{post}', Post::class)->name("blog-post.$lang");

        Route::get('/cart', Cart::class)->name("cart.$lang");
        Route::get('/checkout', Checkout::class)->name("checkout.$lang");
        Route::get('/contact', Contact::class)->name("contact.$lang");
        Route::get('/payment', Payment::class)->name("payment.$lang");
        Route::get('/newsletter', SignUp::class)->name("newsletter.$lang");
        Route::get('/products/{category_primary?}/{category_secondary?}/{category_tertiary?}', Listing::class)->name("products.$lang");
        Route::get('/product/{id}/{slug}', Single::class)->name("product.$lang");
        Route::get('/search', Search::class)->name("search.$lang");
        Route::get('/terms', Terms::class)->name("terms.$lang");
        Route::get('/privacy-policy', PrivacyPolicy::class)->name("privacy.$lang");

        Route::middleware('auth')->group(function () use ($lang) {
            Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)->middleware('signed')->name("verification.verify.$lang");
            Route::post('logout', LogoutController::class)->name("logout.$lang");
        });

        Route::middleware('auth')->prefix('/profile')->group(function () use ($lang) {
            Route::get('/', ViewProfile::class)->name("profile.$lang");
            Route::get('/orders', Orders::class)->name("orders.$lang");
            Route::get('/b2b', B2B::class)->name("b2b.$lang");
        });

        Route::get('/payment/payu', PayU::class)->name("order.payment.payu.$lang");
        Route::get('/payment/transfer', Transfer::class)->name("order.payment.transfer.$lang");
        Route::get('/payment/cash', Cash::class)->name("order.payment.cash.$lang");
        Route::get('/payment/custom', Custom::class)->name("order.payment.custom.$lang");
        Route::get('/delivery/ups', UPS::class)->name("order.callback.ups.$lang");
        Route::get('/delivery/fedex', FedEx::class)->name("order.callback.fedex.$lang");
        Route::get('/status/payu', \App\Livewire\Customer\Status\PayU::class)->name("order.status.payu.$lang");
        Route::get('/status/transfer', \App\Livewire\Customer\Status\Transfer::class)->name("order.status.transfer.$lang");
        Route::get('/status/ups', \App\Livewire\Customer\Status\UPS::class)->name("order.status.ups.$lang");
        Route::get('/status/fedex', \App\Livewire\Customer\Status\FedEx::class)->name("order.status.fedex.$lang");

        Route::get('password/reset', Email::class)->name("password.request.$lang");

        Route::get('password/reset/{token}', Reset::class)->name("password.reset.$lang");
    });

    Route::middleware('auth')->group(function () {
        Route::get('email/verify', Verify::class)->middleware('throttle:6,1')->name('verification.notice');

        Route::get('password/confirm', Confirm::class)->name('password.confirm');
    });
}
