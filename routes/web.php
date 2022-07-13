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
use App\Http\Controllers\DashboardInstallmentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HistoryController;
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
use App\Http\Controllers\InstallmentController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth', 'permit:superadmin,admin,estimator,teknisi');


// Route for Products Dashboard
Route::get('/dashboard/products/checkSlug', [DashboardProductController::class, 'checkSlug'])->middleware('auth', 'permit:superadmin,admin');

Route::resource('/dashboard/products', DashboardProductController::class)->middleware('auth', 'permit:superadmin,admin');


//Route for Categories Dashboard
Route::get('/dashboard/categories/checkSlug', [DashboardCategoryController::class, 'checkSlug'])->middleware('auth', 'permit:superadmin,admin');
Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('auth', 'permit:superadmin,admin');

//Route for Customers Dashboard
Route::resource('/dashboard/customers', DashboardCustomerController::class)->parameters(['customers' => 'user',])->scoped(['user' => 'userName',])->middleware('auth', 'permit:superadmin,admin');

//Route for order
Route::resource('/orders', OrderController::class)->middleware('auth');
Route::get('/users/order-list/{order}', function (Order $order) {
    return view('order-list', [
        'title' => 'Order List Item',
        'order' => $order->orderItem,
    ]);
});
//Route for Order Dashboard
Route::resource('/dashboard/orders', DashboardOrderController::class)->middleware('auth', 'permit:superadmin,admin');

//Route for Survey
Route::get('/surveys/create/{product:slug}', [SurveyController::class, 'create'])->middleware('auth');
Route::resource('/surveys', SurveyController::class)->middleware('auth');
//Route for Survey Dashboard
Route::get('/dashboard/surveys/checkOrder', [DashboardSurveyController::class, 'checkOrder'])->middleware('auth');
Route::get('/dashboard/surveys/download/{id}', [DashboardSurveyController::class, 'downloadFile'])->name('surveys.downloadFile')->middleware('auth');
Route::resource('/dashboard/surveys', DashboardSurveyController::class);

//Route for Profil
Route::get('/profil/{user:userName}/editPassword', [ProfilController::class, 'editPassword'])->middleware('auth');
Route::put('/profil/{user:userName}/updatePassword', [ProfilController::class, 'updatePassword'])->middleware('auth');
Route::resource('/profil', ProfilController::class)->parameters(['profil' => 'user',])->scoped(['user' => 'userName',])->middleware('auth');

//Route for Cart
Route::get('/cart/add/{id}', [CartController::class, 'add_cart']);
Route::resource('/cart', Cart::class);
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

// Route for Payment Availability 
Route::group([
    'middleware' => ['auth', 'permit:superadmin,admin'],
    'prefix' => 'dashboard'
], function () {
    Route::resource('/confirmation', DashboardConfirmationController::class);
    Route::patch('/confirmation/denied/{id}', [DashboardConfirmationController::class, 'denied'])->name('confirmation.denied');
    Route::patch('/confirmation/approved/{id}', [DashboardConfirmationController::class, 'approved'])->name('confirmation.approved');
});

//Route for Payment for order survey product Dashboard
Route::get('/dashboard/payments/download/{id}', [DashboardPaymentController::class, 'downloadFile'])->name('payments.downloadFile')->middleware('auth', 'permit:superadmin,admin,estimator');
Route::resource('/payments', PaymentController::class)->middleware('auth');

//Route for StaffList Dashboard
Route::resource('/dashboard/staffs', DashboardStaffController::class)->parameters(['staffs' => 'user',])->scoped(['user' => 'userName',])->middleware('auth', 'permit:superadmin');


Route::resource('/invoices', InvoiceController::class)->middleware('auth', 'permit:superadmin,admin,estimator');

Route::put('/dashboard/invoices/{invoice}/validation', [DashboardInvoiceController::class, 'validationInvoice'])->middleware('auth', 'permit:superadmin');

Route::get('/dashboard/invoices/checkOrder', [DashboardInvoiceController::class, 'checkOrder'])->middleware('auth', 'permit:superadmin,admin,estimator');
Route::get('/dashboard/invoices/download/{id}', [DashboardInvoiceController::class, 'downloadFile'])->name('invoices.downloadFile')->middleware('auth', 'permit:superadmin,admin,estimator,customer');
Route::resource('/dashboard/invoices', DashboardInvoiceController::class)->middleware('auth', 'permit:superadmin,admin,estimator');

Route::resource('/dashboard/payments', DashboardPaymentController::class)->middleware('auth', 'permit:superadmin,admin,estimator');

Route::get('/dashboard/productions/{production}/confirmProduction', [DashboardProductionController::class, 'updateConfirmProduction'])->middleware('auth', 'permit:superadmin,admin,teknisi');

Route::put('/dashboard/productions/{production}/confirmProduction', [DashboardProductionController::class, 'confirmProduction'])->middleware('auth', 'permit:superadmin,admin,teknisi');

Route::get('/dashboard/productions/checkOrder', [DashboardProductionController::class, 'checkOrder'])->middleware('auth', 'permit:superadmin,admin,teknisi');

Route::resource('/dashboard/productions', DashboardProductionController::class)->middleware('auth', 'permit:superadmin,admin,teknisi');

//Route for Installment Dashboard
Route::get('/dashboard/installments/{installment}/confirmInstallment', [DashboardInstallmentController::class, 'updateConfirmInstallment'])->middleware('auth', 'permit:superadmin,admin,teknisi');
Route::put('/dashboard/installments/{installment}/confirmInstallment', [DashboardInstallmentController::class, 'confirmInstallment'])->middleware('auth', 'permit:superadmin,admin,teknisi');
Route::get('/dashboard/installments/checkProduction', [DashboardInstallmentController::class, 'checkProduction'])->middleware('auth', 'permit:superadmin,admin,teknisi');
Route::resource('/dashboard/installments', DashboardInstallmentController::class)->middleware('auth', 'permit:superadmin,admin,teknisi');
//Route for Installment Customer side
Route::put('/installments/{installment}/confirmation', [InstallmentController::class, 'confirmationSchedule'])->middleware('auth');
Route::resource('/installments', InstallmentController::class)->middleware('auth');

Route::get('/notif', [NotifikasiController::class, 'notif'])->name('notif');
Route::get('/notif_teknisi', [NotifikasiController::class, 'notif_teknisi'])->name('notif_teknisi');
Route::get('/notif_estimator', [NotifikasiController::class, 'notif_estimator'])->name('notif_estimator');
Route::get('/notif_customer', [NotifikasiController::class, 'notif_customer'])->middleware();

Route::get('/total_cart', [CartController::class, 'total_cart']);

Route::get('/total_surveys', [SurveyController::class, 'total_surveys'])->middleware('auth');

Route::get('/total_pemesanan', [CustomerController::class, 'total_pemesanan'])->middleware('auth');

Route::get('/total_invoice', [CustomerController::class, 'total_invoice'])->middleware('auth');

Route::get('/total_installments', [CustomerController::class, 'total_installments'])->middleware('auth');

Route::get('/checkout_read/{id}/{kategori}', [NotifikasiController::class, 'checkout_read']);

Route::resource('/history', HistoryController::class)->middleware('auth');
