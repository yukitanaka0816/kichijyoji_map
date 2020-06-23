
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
Route::get('/shop_items', 'ShopItemController@index')->name('shop_items');

Route::post('shop_items/{category_id}', 'ShopItemController@category')->name('shop_items.category');

Route::get('shop_items/{shop_id}', 'ShopItemController@show')->name('shop_items.show');

Route::PATCH('shop_items/{shop_id}', 'ShopItemController@toggleWant')->name('shop_items.wants');

Route::post('shop_items/{shop_id}', 'CommentController@store')->name('shop_items.store');



//ルート作成画面
Route::get('/wants', 'WantController@index')->name('wants');

Route::post('/wants/{shop_id}', 'WantController@show')->name('wants.show');

Route::delete('/wants', 'WantController@destroy')->name('wants.destroy');

Route::patch('/wants', 'WantController@update')->name('wants.update');



//口コミ投稿、閲覧画面
Route::get('/comments', 'CommentController@index')->name('comments');

Route::post('/comments', 'CommentController@store')->name('comments.store');




//お問い合わせ画面
Route::get('/inquiries', 'InquiryController@index')->name('inquiries');

ROute::post('/inquiries', 'InquiryController@store')->name('inquiries.store');



// 管理者画面（お問い合わせ内容一覧）
Route::get('/admin/inquiries', 'AdminController@index');



//ログイン
Auth::routes();
