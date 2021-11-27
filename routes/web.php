<?php

use Illuminate\Support\Facades\Route;

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

Route::view('home', 'index');

Route::get('/backend_home', function () {
    return view('welcome');
})->name('home');

// 渲染 latex 測試頁面
Route::get('katex-test', function () {
    return view('katex-test');
});
