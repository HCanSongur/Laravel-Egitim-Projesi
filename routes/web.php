<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\OrderController;

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


Route::get('/', [HomeController::class , 'home'])->name('welcome')->middleware('setLocale');
Route::get('/dil-degistir', [HomeController::class , 'changelocale'])->name('changelocale');
Route::get('/kitaplar/disa-aktar',[ BookController::class , 'export'])->name('users.books.export');
Route::get('/kitaplar/{id}', [HomeController::class , 'show'])->name('users.book.show');

Route::get('/sepet', [ShoppingController::class , 'index'])->name('shopping.index');
Route::get('/sepete-ekle/{id}', [ShoppingController::class , 'addtocart'])->name('shopping.addtocart');
Route::get('/sepetten-cikar/{row_id}', [ShoppingController::class , 'removefromcart'])->name('shopping.removefromcart');
Route::get('/sepeti-guncelle/{row_id}/{type}', [ShoppingController::class , 'updatecart'])->name('shopping.updatecart');
Route::post('/siparisi-olustur', [OrderController::class , 'store'])->name('orders.store');



// Route::controller(TestController::class)->group(function(){
//     Route::get('admin/test','test')->name('test');
//     Route::get('admin/detail','detail')->name('detail');
    
// });


Route::prefix('admin')->middleware('admin')->group(function(){

    Route::get('/test',  [ TestController::class , 'test'])->name('test');
    Route::get('/detail',[ TestController::class , 'detail'])->name('detail');
    
    Route::get('/kitaplar',[ BookController::class , 'index'])->name('books.index');
    Route::get('/kitaplar/ekle',[ BookController::class , 'create'])->name('books.create');
    Route::post('/kitaplar/ekle/',[ BookController::class , 'store'])->name('books.store');
    Route::post('/kitaplar/dısa-aktar',[ BookController::class , 'import'])->name('books.import');
    Route::get('/kitaplar/{book}',[ BookController::class , 'edit'])->name('books.edit');
    Route::post('/kitaplar/{book}',[ BookController::class , 'update'])->name('books.update');
    Route::get('/kitaplar/sil/{book}',[ BookController::class , 'delete'])->name('books.delete');
    Route::get('/kitaplar/geri-getir/{book}',[ BookController::class , 'restore'])->name('books.restore')->WithTrashed();




});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


