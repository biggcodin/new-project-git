<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserAccountController;
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

// 🌟 تست صفحات و ویوها
Route::get('a', fn() => view('product-details'));
Route::get('b', fn() => view('user.user-panel'));
Route::get('c', fn() => view('user.cart'));
Route::get('d', [ArticleController::class, 'showNews']);

// 🏠 صفحه اصلی
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/index', [HomeController::class, 'index']);
Route::redirect('/index.html', '/', 301);

// 🔐 احراز هویت
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// 👤 مسیرهای کاربر
Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('user-dashboard'))->name('dashboard');
    
    Route::get('/user-panel', function() {
        return view('user.user-panel');
    })->name('user.panel');
    
    Route::get('/account', fn () => redirect()->route('user.account.create'))->name('user.account');
    Route::get('/account/create', [UserAccountController::class, 'create'])->name('user.account.create');
    Route::post('/account', [UserAccountController::class, 'store'])->name('user.account.store');
    
    // 🛒 سبد خرید
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// هدایت آدرس‌های اشتباه
Route::redirect('/user/admin', '/admin');
Route::get('/user/admin/{path}', function (string $path) {
    return redirect('/admin/' . $path);
})->where('path', '.*');


// 🌐 مسیرهای عمومی
Route::get('/product-fields', [CustomFieldController::class, 'getFields'])->name('products.getFields');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// AJAX routes for categories
Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories'])->name('get.subcategories');
Route::get('/get-subsubcategories/{subcategoryId}', [ProductController::class, 'getSubSubcategories'])->name('get.subsubcategories');

// 🌐 مسیرهای عمومی سمت کاربر
Route::get('/products', [ProductController::class, 'showProducts'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'showSingleProduct'])->name('products.single');

// 🌐 نظرات
Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

// 🛠 مسیرهای پنل مدیریت
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard');

    Route::get('/pending-products', [ProductApprovalController::class, 'index'])->name('pending.products');

    // عملیات تایید و رد
    Route::post('/pending-products/{product}/approve', [ProductApprovalController::class, 'approve'])->name('pending.products.approve');
    Route::post('/pending-products/{product}/reject', [ProductApprovalController::class, 'reject'])->name('pending.products.reject');

    Route::get('/pending-users', [UserApprovalController::class, 'pendingIndex'])->name('pending.users');
    Route::post('/pending-users/{user}/approve', [UserApprovalController::class, 'approve'])->name('pending.users.approve');
    Route::post('/pending-users/{user}/reject', [UserApprovalController::class, 'reject'])->name('pending.users.reject');

    Route::get('/users', [UserApprovalController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserApprovalController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserApprovalController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserApprovalController::class, 'destroy'])->name('users.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{type}/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{type}/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    
    Route::get('/custom-fields', [CustomFieldController::class, 'index'])->name('custom-fields.index');
    Route::get('/custom-fields/create', [CustomFieldController::class, 'create'])->name('custom-fields.create');
    Route::post('/custom-fields', [CustomFieldController::class, 'store'])->name('custom-fields.store');
    Route::get('/custom-fields/{customField}/edit', [CustomFieldController::class, 'edit'])->name('custom-fields.edit');
    Route::put('/custom-fields/{customField}', [CustomFieldController::class, 'update'])->name('custom-fields.update');
    Route::delete('/custom-fields/{customField}', [CustomFieldController::class, 'destroy'])->name('custom-fields.destroy');

    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    Route::resource('sliders', SliderController::class)->except(['show']);
    Route::resource('articles', ArticleController::class);
    Route::delete('/articles/{article}/image', [ArticleController::class, 'destroyImage'])->name('articles.image.destroy');
    Route::delete('/articles/attachments/{attachment}', [ArticleController::class, 'destroyAttachment'])->name('attachments.destroy');
    Route::resource('videos', VideoController::class);

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::delete('/products/media/{id}', [ProductController::class, 'destroyMedia'])->name('admin.products.destroyMedia');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/product-fields', [CustomFieldController::class, 'getFields'])->name('product.fields');

});

// 🌐 مسیرهای عمومی مقالات (قابل دسترسی برای همه)
Route::get('/news', [ArticleController::class, 'showNews'])->name('news.index');
Route::get('/news/{slug}', [ArticleController::class, 'showSingleArticle'])->name('news.single');
Route::get('/tags/{slug}', [ArticleController::class, 'showArticlesByTag'])->name('articles.tag');