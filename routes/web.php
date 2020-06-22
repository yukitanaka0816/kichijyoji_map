<?php

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


//お店選択画面
Route::get('shop_items', 'ShopItemController@index');

Route::post('shop_items/{category_id}', 'ShopItemController@category');

Route::get('shop_items/{shop_id}', 'ShopItemController@show');

Route::PATCH('shop_items/{shop_id}', 'ShopItemController@toggleWant');

Route::post('shop_items/{shop_id}', 'CommentController@store');



//ルート作成画面
Route::get('wants', 'WantController@index');

Route::post('wants/{shop_id}', 'WantController@show');

Route::delete('wants', 'WantController@destroy');

Route::patch('wants', 'WantController@update');



//口コミ投稿、閲覧画面
Route::get('/comments', 'CommentController@index');

Route::post('/comments', 'CommentController@store');



//お問い合わせ画面
Route::get('inquiries', 'InquiryController@index');

Route::post('inquiries', 'InquiryController@store');




