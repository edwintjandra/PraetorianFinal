<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/clothes',[ClothesController::class,'index'])->name('clothes.index');
Route::middleware('CheckRole')->group(function () {
Route::get('/clothes/create',[ClothesController::class,'create'])->name('clothes.create');
Route::post('/clothes',[ClothesController::class,'store'])->name('clothes.store');
Route::get('/clothes/{id}/edit',[ClothesController::class,'edit'])->name('clothes.edit');
Route::put('/clothes/{id}/edit',[ClothesController::class,'update'])->name('clothes.update');
Route::delete('/clothes/{id}',[ClothesController::class,'delete'])->name('clothes.delete');
});

Route::middleware('CheckRole')->group(function () {
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('/category',[CategoryController::class,'store'])->name('category.store');
Route::delete('/category/{id}',[CategoryController::class,'delete'])->name('category.delete');
});

Route::get('/register', [RegisterController::class,'create'])->name('register');
Route::post('/register', [RegisterController::class,'store'])->name('register.store');

Route::get('/login', [LoginController::class,'create'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('clothes.index');
})->name('logout');


Route::middleware('RequireLogin')->group(function () {
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-cart/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
Route::delete('delete-cart/{id}', [ProductController::class, 'removeCart'])->name('cart.delete');
Route::post('checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::get('checkout', [ProductController::class, 'checkoutIndex'])->name('checkout.index');

});