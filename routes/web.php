<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomFieldController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductApprovalController;

// 🌟 تست صفحات و ویوها
Route::get('a', fn() => view('product-details'));
Route::get('b', fn() => view('user.user-panel'));
Route::get('c', fn() => view('user.cart'));
Route::get('d', fn() => view('news'));

// 🏠 صفحه اصلی
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ✅ مسیرهای احراز هویت
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// 👤 مسیرهای کاربر
Route::prefix('user')->group(function () {
    Route::get('/dashboard', fn() => view('user-dashboard'))->name('dashboard');

    Route::get('/account/create', [UserAccountController::class, 'create'])->name('user.account.create');
    Route::post('/account', [UserAccountController::class, 'store'])->name('user.account.store');
});

// 🌐 مسیرهای عمومی خارج از پنل ادمین
Route::get('/product-fields', [ProductController::class, 'getFields'])->name('products.getFields');

// 🛠 مسیرهای پنل مدیریت
// اگر میخوای در آینده میدل‌ویر `auth` و `AdminMiddleware` رو فعال کنی، اینجا اضافه کن
Route::prefix('admin')->group(function () {

    // 🌟 تأیید محصولات توسط مدیر
    Route::get('/pending-products', [ProductApprovalController::class, 'index'])->name('pending.products');
    Route::post('/pending-products/{product}/approve', [ProductApprovalController::class, 'approve'])->name('pending.products.approve');
    Route::post('/pending-products/{product}/reject', [ProductApprovalController::class, 'reject'])->name('pending.products.reject');

    // 📁 دسته‌بندی‌ها (3 سطح)
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{type}/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{type}/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // 🧩 فیلدهای سفارشی محصولات
    Route::get('/custom-fields', [CustomFieldController::class, 'index'])->name('custom-fields.index');
    Route::post('/custom-fields', [CustomFieldController::class, 'store'])->name('custom-fields.store');
    Route::get('/custom-fields/{customField}/edit', [CustomFieldController::class, 'edit'])->name('custom-fields.edit');
    Route::put('/custom-fields/{customField}', [CustomFieldController::class, 'update'])->name('custom-fields.update');
    Route::delete('/custom-fields/{customField}', [CustomFieldController::class, 'destroy'])->name('custom-fields.destroy');

    // 🏷️ تگ‌ها
    Route::resource('tags', TagController::class);

    // 🖼️ اسلایدرها
    Route::resource('sliders', SliderController::class);

    // 📰 مقالات
    Route::resource('articles', ArticleController::class);
    Route::delete('/articles/{article}/image', [ArticleController::class, 'destroyImage'])->name('articles.image.destroy');
    Route::delete('/articles/attachments/{attachment}', [ArticleController::class, 'destroyAttachment'])->name('attachments.destroy');

    // 🎬 ویدیوها
    Route::resource('videos', VideoController::class);

    // 🛍️ محصولات
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/product-fields', [ProductController::class, 'getFields'])->name('product.fields');
});

// 🌐 مقالات و اخبار سمت فرانت
Route::get('/news', [ArticleController::class, 'showNews'])->name('news.index');
Route::get('/news/{slug}', [ArticleController::class, 'showSingleArticle'])->name('news.single');
Route::get('/tags/{slug}', [ArticleController::class, 'showArticlesByTag'])->name('articles.tag');
