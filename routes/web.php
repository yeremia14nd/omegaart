<?php


use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardConfirmationController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSurveyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardOrderController;
use App\Http\Controllers\DashboardStaffController;
use App\Http\Controllers\DashboardInvoiceController;
use App\Http\Controllers\DashboardPaymentController;
use App\Http\Controllers\DashboardProductionController;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotifikasiController;

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

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => 'home',
        "products" => Product::paginate(6),

    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => 'about',

    ]);
});
Route::get('/contact', function () {
    return view('contact', [
        "title" => "Contact",
        "active" => 'contact',

    ]);
});

Route::get('/cart', function () {
    return view('cart', [
        "title" => "Cart",
        "active" => 'cart',
    ]);
});

Route::get('/shop', [ProductController::class, 'index']);

Route::get('/products/{product:slug}', [ProductController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Product Categories',
        "active" => 'shop',
        'categories' => Category::all(),
    ]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('category', [
        'title' => "Product by Category: $category->name",
        "active" => 'shop',
        'products' => $category->products,
    ]);
});

Route::resource('/orders', OrderController::class)->middleware('auth');

Route::get('/users/order-list/{order}', function (Order $order) {
    return view('order-list', [
        'title' => 'Order List Item',
        'order' => $order->orderItem,
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


// Route for Products Dashboard
Route::get('/dashboard/products/checkSlug', [DashboardProductController::class, 'checkSlug'])->middleware('auth');

Route::resource('/dashboard/products', DashboardProductController::class)->middleware('auth');


//Route for Categories Dashboord
Route::get('/dashboard/categories/checkSlug', [DashboardCategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('auth');

Route::resource('/dashboard/customers', DashboardCustomerController::class)->parameters(['customers' => 'user',])->scoped(['user' => 'userName',])->middleware('auth');

Route::get('/cart/add/{id}', [CartController::class, 'add_cart']);
Route::resource('/cart', Cart::class);

Route::get('/surveys/create/{product:slug}', [SurveyController::class, 'create'])->middleware('auth');
Route::resource('/surveys', SurveyController::class)->middleware('auth');

Route::get('/dashboard/surveys/checkOrder', [DashboardSurveyController::class, 'checkOrder'])->middleware('auth');

Route::get('/dashboard/surveys/download/{id}', [DashboardSurveyController::class, 'downloadFile'])->name('surveys.downloadFile')->middleware('auth');

Route::resource('/dashboard/surveys', DashboardSurveyController::class)->middleware('auth');

Route::resource('/profil', ProfilController::class)->parameters(['profil' => 'user',])->scoped(['user' => 'userName',])->middleware('auth');

// shopping cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/store', [CartItemController::class, 'store'])->name('cart.store');
    Route::patch('/update/{id}', [CartItemController::class, 'update'])->name('cart.update');
    Route::delete('/destroy/{id}', [CartItemController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/kosongkan/{id}', [CartController::class, 'kosongkan'])->name('cart.kosongkan');

    //cart session
    Route::delete('/remove-from-cart/{id}', [CartItemController::class, 'remove'])->name('cart.remove');
    Route::patch('/update-quantity/{id}', [CartItemController::class, 'update_quantity'])->name('cart.quantity');
    Route::post('/empty_session', [CartController::class, 'emptySession'])->name('cart.empty');
});

// payment
Route::group(['middleware' => 'auth', 'prefix' => 'checkout'], function () {
    Route::get('/{id}', [PaymentController::class, 'index'])->name('checkout');
    Route::post('/add', [PaymentController::class, 'add_checkout'])->name('checkout.add');
    Route::patch('/payment/{id}', [PaymentController::class, 'payment'])->name('checkout.payment');
    Route::get('/confirmation/{id}', [PaymentController::class, 'confirmation_payment'])->name('checkout.confirmation');
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::resource('/confirmation', DashboardConfirmationController::class);
    Route::patch('/confirmation/denied/{id}', [DashboardConfirmationController::class, 'denied'])->name('confirmation.denied');
    Route::patch('/confirmation/approved/{id}', [DashboardConfirmationController::class, 'approved'])->name('confirmation.approved');
});

Route::get('/dashboard/payments/download/{id}', [DashboardPaymentController::class, 'downloadFile'])->name('payments.downloadFile')->middleware('auth');

// Payment for order survey product
Route::resource('/payments', PaymentController::class)->middleware('auth');


Route::resource('/dashboard/orders', DashboardOrderController::class)->middleware('auth');

Route::resource('/dashboard/staffs', DashboardStaffController::class)->parameters(['staffs' => 'user',])->scoped(['user' => 'userName',])->middleware('auth');

Route::resource('/invoices', InvoiceController::class)->middleware('auth');

Route::get('/dashboard/invoices/download/{id}', [DashboardInvoiceController::class, 'downloadFile'])->name('invoices.downloadFile')->middleware('auth');
Route::resource('/dashboard/invoices', DashboardInvoiceController::class)->middleware('auth');

Route::resource('/dashboard/payments', DashboardPaymentController::class)->middleware('auth');

Route::get('/dashboard/productions/checkOrder', [DashboardProductionController::class, 'checkOrder'])->middleware('auth');

Route::resource('/dashboard/productions', DashboardProductionController::class)->middleware('auth');

Route::get('/notif', [NotifikasiController::class, 'notif'])->name('notif');

Route::get('/total_cart', [CartController::class, 'total_cart']);

