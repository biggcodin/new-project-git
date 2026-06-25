<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomFieldController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductApprovalController;
use App\Http\Controllers\Admin\UserApprovalController;
use App\Http\Controllers\Admin\SellerApplicationAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\SellerRequestController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SellerApplicationController;

// ======================================================================
// 🌟 بخش تست صفحات و ویوهای موقت
// ======================================================================
Route::get('a', fn() => view('product-details'));
Route::get('b', fn() => view('user.user-panel'));
Route::get('c', fn() => view('user.cart'));
Route::get('d', [ArticleController::class, 'showNews']);

// ======================================================================
// 🏠 صفحه اصلی
// ======================================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/index', [HomeController::class, 'index']);
Route::redirect('/index.html', '/', 301);

// ======================================================================
// 🔐 احراز هویت (ورود، ثبت‌نام، خروج)
// ======================================================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// ======================================================================
// 👤 مسیرهای پنل کاربری (نیازمند احراز هویت)
// ======================================================================
Route::prefix('user')->middleware('auth')->group(function () {

    // ----- داشبورد و پنل کاربر -----
    Route::get('/dashboard', fn() => view('user.user-panel'))->name('dashboard');
    Route::get('/user-panel', function () {
        return view('user.user-panel');
    })->name('user.panel');

    // ----- کیف پول (شارژ، تاریخچه) -----
    Route::get('/wallet/charge', [UserController::class, 'walletCharge'])->name('wallet.charge');
    Route::post('/wallet/charge', [UserController::class, 'charge'])->name('wallet.charge.submit');
    Route::get('/wallet/history', [UserController::class, 'walletHistory'])->name('wallet.history');

    // ----- خریدهای من و جزئیات سفارش -----
    Route::get('/purchases', [UserController::class, 'purchases'])->name('user.purchases');
    Route::get('/order/{order}', [UserController::class, 'orderDetails'])->name('order.details');

    // ----- آگهی‌ها، پیام‌ها و ویرایش پروفایل -----
    Route::get('/ads', [UserController::class, 'ads'])->name('user.ads');
    Route::get('/chat', [UserController::class, 'chat'])->name('user.chat');
    Route::get('/profile/edit', [UserController::class, 'profileEdit'])->name('user.profile.edit');
    Route::put('/profile', [UserController::class, 'profileUpdate'])->name('user.profile.update');

    // ----- مدیریت درخواست‌های محصولات (آگهی‌ها) -----
    Route::prefix('product-application')->name('user.product-application.')->group(function () {
        Route::get('/{application}/edit', [UserController::class, 'editProductApplication'])->name('edit');
        Route::put('/{application}', [UserController::class, 'updateProductApplication'])->name('update');
    });

    // ----- 🛒 سبد خرید (مدیریت آیتم‌ها) -----
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // ----- 💳 تسویه حساب و پرداخت (کیف پول / درگاه) -----
    Route::post('/checkout/wallet', [CheckoutController::class, 'payWithWallet'])->name('checkout.wallet');
    Route::post('/checkout/gateway', [CheckoutController::class, 'payWithGateway'])->name('checkout.gateway');
    Route::get('/gateway/simulate/{order}', [CheckoutController::class, 'simulateGateway'])->name('gateway.simulate');
    Route::get('/gateway/callback', [CheckoutController::class, 'gatewayCallback'])->name('gateway.callback');

    // ----- 🏷️ اعمال کد تخفیف (AJAX) -----
    Route::post('/discount/apply', [DiscountController::class, 'apply'])->name('discount.apply');

    // ----- 📝 درخواست فروشندگی (قدیمی - در صورت نیاز) -----
    Route::get('/seller-request', [SellerRequestController::class, 'create'])->name('seller.request.create');
    Route::post('/seller-request', [SellerRequestController::class, 'store'])->name('seller.request.store');
});

// ======================================================================
// 📝 مسیرهای فرم ویزارد درخواست فروش اکانت (جدید)
// ======================================================================
Route::prefix('seller/product-request')->name('seller.product.request.')->middleware('auth')->group(function () {
    Route::get('/', [SellerApplicationController::class, 'createProduct'])->name('index');
    Route::post('/store', [SellerApplicationController::class, 'store'])->name('store');
    Route::get('/get-fields', [SellerApplicationController::class, 'getFields'])->name('getFields');
});

// مسیر مستقل برای ثبت آگهی جدید (ویزارد ۳ مرحله‌ای)
Route::get('/seller/product/create', [SellerApplicationController::class, 'createProduct'])
    ->name('seller.product.create')
    ->middleware('auth');

// ======================================================================
// 🔄 هدایت آدرس‌های اشتباه (سازگاری با نسخه‌های قبلی)
// ======================================================================
Route::redirect('/user/admin', '/admin');
Route::get('/user/admin/{path}', function (string $path) {
    return redirect('/admin/' . $path);
})->where('path', '.*');

// ======================================================================
// 🌐 مسیرهای عمومی (بدون نیاز به احراز هویت)
// ======================================================================

// ----- دریافت فیلدهای سفارشی برای فرم محصولات (AJAX) -----
Route::get('/product-fields', [CustomFieldController::class, 'getFields'])->name('products.getFields');

// ----- دریافت زیردسته‌ها و زیرزیردسته‌ها (AJAX) -----
Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories'])->name('get.subcategories');
Route::get('/get-subsubcategories/{subcategoryId}', [ProductController::class, 'getSubSubcategories'])->name('get.subsubcategories');

// ----- نمایش محصولات در سایت (برای کاربران عادی) -----
Route::get('/products', [ProductController::class, 'showProducts'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'showSingleProduct'])->name('products.single');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// ----- ثبت نظر برای مقالات (عمومی) -----
Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

// ----- مقالات و برچسب‌ها (عمومی) -----
Route::get('/news', [ArticleController::class, 'showNews'])->name('news.index');
Route::get('/news/{slug}', [ArticleController::class, 'showSingleArticle'])->name('news.single');
Route::get('/tags/{slug}', [ArticleController::class, 'showArticlesByTag'])->name('articles.tag');

// ======================================================================
// 🛠 مسیرهای پنل مدیریت (ادمین) – نیازمند احراز هویت و نقش admin
// ======================================================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // ----- داشبورد مدیریت -----
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard');

    // ----- مدیریت تایید محصولات (قدیمی - قابل حذف یا نگهداری) -----
    Route::get('/pending-products', [ProductApprovalController::class, 'index'])->name('pending.products');
    Route::post('/pending-products/{product}/approve', [ProductApprovalController::class, 'approve'])->name('pending.products.approve');
    Route::post('/pending-products/{product}/reject', [ProductApprovalController::class, 'reject'])->name('pending.products.reject');

    // ================================================================
    // 🆕 مدیریت یکپارچه فروشندگان (هویت + محصولات)
    // ================================================================
    Route::prefix('seller-applications')->name('seller.applications.')->group(function () {
        Route::get('/', [SellerApplicationAdminController::class, 'index'])->name('index');

        // مدیریت هویت
        Route::post('/{application}/approve-identity', [SellerApplicationAdminController::class, 'approveIdentity'])->name('approve-identity');
        Route::post('/{application}/reject-identity', [SellerApplicationAdminController::class, 'rejectIdentity'])->name('reject-identity');
        Route::get('/{application}/show-identity', [SellerApplicationAdminController::class, 'showIdentity'])->name('show-identity');
        Route::delete('/{application}', [SellerApplicationAdminController::class, 'destroyIdentity'])->name('destroy-identity');
    });

    // ================================================================
    // 🆕 مدیریت محصولات (آگهی‌ها) – برای تأیید/رد جداگانه
    // ================================================================
    Route::prefix('products')->name('products.')->group(function () {
        Route::post('/{product}/approve', [SellerApplicationAdminController::class, 'approveProduct'])->name('approve');
        Route::post('/{product}/reject', [SellerApplicationAdminController::class, 'rejectProduct'])->name('reject');
        Route::get('/{product}/show', [SellerApplicationAdminController::class, 'showProduct'])->name('show');
        Route::delete('/{product}', [SellerApplicationAdminController::class, 'destroyProduct'])->name('destroy');
    });

    // ----- مدیریت کاربران -----
    Route::get('/pending-users', [UserApprovalController::class, 'pendingIndex'])->name('pending.users');
    Route::post('/pending-users/{user}/approve', [UserApprovalController::class, 'approve'])->name('pending.users.approve');
    Route::post('/pending-users/{user}/reject', [UserApprovalController::class, 'reject'])->name('pending.users.reject');

    Route::get('/users', [UserApprovalController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserApprovalController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserApprovalController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserApprovalController::class, 'destroy'])->name('users.destroy');

    // ----- مدیریت دسته‌بندی‌ها (Categories) -----
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{type}/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{type}/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // ----- مدیریت فیلدهای سفارشی (Custom Fields) -----
    Route::get('/custom-fields', [CustomFieldController::class, 'index'])->name('custom-fields.index');
    Route::get('/custom-fields/create', [CustomFieldController::class, 'create'])->name('custom-fields.create');
    Route::post('/custom-fields', [CustomFieldController::class, 'store'])->name('custom-fields.store');
    Route::get('/custom-fields/{customField}/edit', [CustomFieldController::class, 'edit'])->name('custom-fields.edit');
    Route::put('/custom-fields/{customField}', [CustomFieldController::class, 'update'])->name('custom-fields.update');
    Route::delete('/custom-fields/{customField}', [CustomFieldController::class, 'destroy'])->name('custom-fields.destroy');

    // ----- مدیریت برچسب‌ها (Tags) -----
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    // ----- مدیریت اسلایدرها -----
    Route::resource('sliders', SliderController::class)->except(['show']);

    // ----- مدیریت مقالات -----
    Route::resource('articles', ArticleController::class);
    Route::delete('/articles/{article}/image', [ArticleController::class, 'destroyImage'])->name('articles.image.destroy');
    Route::delete('/articles/attachments/{attachment}', [ArticleController::class, 'destroyAttachment'])->name('attachments.destroy');

    // ----- مدیریت ویدیوها -----
    Route::resource('videos', VideoController::class);

    // ----- مدیریت محصولات (لیست و مدیریت در پنل ادمین) -----
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::delete('/products/media/{id}', [ProductController::class, 'destroyMedia'])->name('products.destroyMedia');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/product-fields', [CustomFieldController::class, 'getFields'])->name('product.fields');
});