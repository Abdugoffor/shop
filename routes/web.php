<?php

use App\Http\Controllers\CateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TavarController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Category

Route::get('/cate',[CateController::class, 'index'])->name('cate')->middleware('auth');
Route::post('/cate',[CateController::class, 'store'])->name('cateadd')->middleware('auth');
Route::put('/cate/{id}',[CateController::class, 'edit'])->name('cateedit')->middleware('auth');
Route::delete('/cate/{id}',[CateController::class, 'delete'])->name('delete')->middleware('auth');

// Tavar

Route::get('/tavar',[TavarController::class, 'index'])->name('tavar')->middleware('auth');
Route::post('/tavar',[TavarController::class, 'store'])->name('tavaradd')->middleware('auth');
Route::put('/tavar/{id}',[TavarController::class, 'edit'])->name('tavaredit')->middleware('auth');
Route::delete('/tavar/{id}',[TavarController::class, 'delete'])->name('tavardelete')->middleware('auth');
Route::get('/cart',[TavarController::class, 'cart'])->name('cart')->middleware('auth');
Route::get('/search',[TavarController::class, 'search'])->name('search')->middleware('auth');

// Cart
Route::get('/add-cart/{product}',[TavarController::class, 'addcart'])->name('add-cart')->middleware('auth');
Route::get('/deletecart/{id}',[TavarController::class, 'deletecart'])->name('deletecart')->middleware('auth');
Route::post('/soni/{product}',[TavarController::class, 'soni'])->name('soni')->middleware('auth');
// Route::get('/chakout/{sum}',[TavarController::class, 'chakout'])->name('chakout')->middleware('auth');

// Hamma tavarlar
Route::get('/',[TestController::class,'dash'])->name('dash')->middleware('auth');
Route::get('/savdo',[TestController::class,'index'])->name('savdo')->middleware('auth');
Route::get('/activ/{id}',[TestController::class,'activ'])->name('activ')->middleware('auth');
Route::get('/xisob/{key}',[TestController::class,'xisob'])->name('xisob')->middleware('auth');
Route::get('/date',[TestController::class,'date'])->name('date')->middleware('auth');



require __DIR__.'/auth.php';
