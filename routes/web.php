<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/read/{newsID}',[HomeController::class,'read'])->name('read');
Route::group(['middleware'=>'guest'], function(){
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/dologin',[LoginController::class,'login'])->name('dologin');
});

Route::group(['middleware'=>'auth'], function(){
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    Route::post('/changePass',[LoginController::class,'changePass'])->name('changePass');
    Route::get('/admin',[AdminController::class,'index'])->name('admin');
    Route::get('/newsList',[AdminController::class,'newsList'])->name('newsList');
    Route::get('/insertNews',[AdminController::class,'insertNews'])->name('insertNews');
    Route::post('/addNewCat',[AdminController::class,'addNewCat'])->name('addNewCat');
    Route::post('/postNews',[AdminController::class,'postNews'])->name('postNews');
    Route::get('/deletePost/{newsID}',[AdminController::class,'deletePost'])->name('deletePost');
    Route::get('newsList/editPost/{newsID}',[AdminController::class,'editPost'])->name('editPost');
    Route::post('/editThisPost/{newsID}',[AdminController::class,'editThisPost'])->name('editThisPost');
});