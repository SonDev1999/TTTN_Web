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

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/dangnhap', 'App\Http\Controllers\UserController@getdangnhapAdmin' ); 
Route::post('admin/dangnhap', 'App\Http\Controllers\UserController@postdangnhapAdmin' ); 
Route::get('admin/logout', 'App\Http\Controllers\UserController@getdangxuatAdmin' ); 

Route::group(['prefix'=>'admin','middleware'=>'adminlogin'],function(){
    Route::group(['prefix'=>'theloai'],function(){

        Route::get('danhsach','App\Http\Controllers\TheLoaiController@getDanhSach');

        Route::get('sua/{id}','App\Http\Controllers\TheLoaiController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\TheLoaiController@postSua');

        Route::get('them','App\Http\Controllers\TheLoaiController@getThem');
        Route::post('them','App\Http\Controllers\TheLoaiController@postThem');
        Route::get('xoa/{id}','App\Http\Controllers\TheLoaiController@getXoa');
    });
    Route::group(['prefix'=>'loaitin'],function(){

        Route::get('danhsach','App\Http\Controllers\LoaiTinController@getDanhSach');

        Route::get('sua/{id}','App\Http\Controllers\LoaiTinController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\LoaiTinController@postSua');

        Route::get('them','App\Http\Controllers\LoaiTinController@getThem');
        Route::post('them','App\Http\Controllers\LoaiTinController@postThem');
        Route::get('xoa/{id}','App\Http\Controllers\LoaiTinController@getXoa');
    });
    Route::group(['prefix'=>'tintuc'],function(){

        Route::get('danhsach','App\Http\Controllers\TinTucController@getDanhSach');
        Route::get('xoa/{id}','App\Http\Controllers\TinTucController@getXoa');
        Route::get('sua/{id}','App\Http\Controllers\TinTucController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\TinTucController@postSua');
        Route::get('them','App\Http\Controllers\TinTucController@getThem');
        Route::post('them','App\Http\Controllers\TinTucController@postThem');

    });
    Route::group(['prefix'=>'comment'],function(){

       
        Route::get('xoa/{id}/{idTinTuc}','App\Http\Controllers\CommentController@getXoa');


    });
    Route::group(['prefix'=>'ajax'],function(){
            Route::get('loaitin/{idTheLoai}','App\Http\Controllers\AjaxController@getLoaiTin');
    });
    Route::group(['prefix'=>'user'],function(){

        Route::get('danhsach','App\Http\Controllers\UserController@getDanhSach');
        Route::get('xoa/{id}','App\Http\Controllers\UserController@getXoa');
        Route::get('sua/{id}','App\Http\Controllers\UserController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\UserController@postSua');
        Route::get('them','App\Http\Controllers\UserController@getThem');
        Route::post('them','App\Http\Controllers\UserController@postThem');

    });
});

Route::get('trangchu', 'App\Http\Controllers\PageController@trangchu'); 
Route::get('lienhe', 'App\Http\Controllers\PageController@lienhe'); 
Route::get('loaitin/{id}', 'App\Http\Controllers\PageController@loaitin'); 
Route::get('tintuc/{id}', 'App\Http\Controllers\PageController@tintuc'); 
Route::get('dangnhap', 'App\Http\Controllers\PageController@getDangnhap'); 
Route::post('dangnhap', 'App\Http\Controllers\PageController@postDangnhap'); 
Route::get('dangxuat', 'App\Http\Controllers\PageController@getDangxuat'); 

Route::get('dangky', 'App\Http\Controllers\PageController@getDangky');
Route::post('dangky', 'App\Http\Controllers\PageController@postDangky');
Route::post('comment/{id}', 'App\Http\Controllers\CommentController@postComment'); 
Route::get('timkiem','App\Http\Controllers\PageController@gettimkiem');
Route::get('nguoidung','App\Http\Controllers\PageController@getnguoidung');
Route::post('nguoidung','App\Http\Controllers\PageController@postnguoidung');