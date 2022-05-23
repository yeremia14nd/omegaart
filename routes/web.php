<?php


use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSurveyController;
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

Route::get('/users/{user}', function (User $user) {
    return view('orders', [
        'title' => 'User Orders',
        'orders' => $user->order,
    ]);
});

Route::get('/users/order-list/{order}', function (Order $order) {
    return view('order-list', [
        'title' => 'Order List Item',
        'order' => $order->orderItem,
    ]);
});

// Route::get('/cart/{user}', function (User $user) {
//     return view('cart', [
//         'title' => 'User Cart',
//         'cart' => $user->cart,
//     ]);
// });

// Route::get('/cart/cart-list/{cart}', function (Cart $cart) {
//     return view('cart-list', [
//         'title' => 'Cart List Item',
//         'cart' => $cart->cartItem,
//     ]);
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');


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

Route::resource('/dashboard/surveys', DashboardSurveyController::class)->middleware('auth');

Route::resource('/profil', ProfilController::class)->parameters(['profil' => 'user',])->scoped(['user' => 'userName',])->middleware('auth');
