
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

Route::get('/shop_items/{category_id}', 'ShopItemController@category')->name('shop_items.category');

Route::get('/shop_items/show/{shop_id}', 'ShopItemController@show')->name('shop_items.show');

Route::post('/shop_items/wants/{shop_id}', 'ShopItemController@toggleWant')->name('shop_items.wants');

Route::post('/shop_items/store/{shop_id}', 'CommentController@store')->name('shop_items.store');



//ルート作成画面
Route::get('/wants', 'WantController@index')->name('wants');

Route::post('/wants/{shop_id}', 'WantController@show')->name('wants.show');

Route::delete('/wants/{id}', 'WantController@destroy')->name('wants.destroy');

Route::patch('/wants', 'WantController@update')->name('wants.update');



//口コミ投稿、閲覧画面
Route::get('/comments/{shop_id}', 'CommentController@show')->name('comments');

Route::post('/comments/{shop_id}', 'CommentController@store')->name('comments.store');


//新規地点投稿
Route::get('/post', 'PostPlaceController@index')->name('post.index');

Route::post('/post', 'PostPlaceController@store')->name('post.store');



//お問い合わせ画面
Route::get('/inquiries', 'InquiryController@index')->name('inquiries');

ROute::post('/inquiries', 'InquiryController@store')->name('inquiries.store');



// 管理者画面
// お問い合わせ内容一覧
Route::get('/admin/inquiries', 'AdminController@index_inquiries');

// 店舗一覧
Route::get('/admin/shop_items', 'AdminController@index_shop_items');

// ユーザー一覧
Route::get('/admin/users', 'AdminController@index_users');

// ユーザー削除
Route::delete('/admin/users/{id}', 'AdminController@destroy_user');

// 営業時間
Route::patch('admin/shop_items/business_hours/{id}', 'AdminController@update_business_hours');

// URL
Route::patch('admin/shop_items/url/{id}', 'AdminController@update_url');

// 公開ステータス
Route::patch('/admin/shop_items/status/{id}', 'AdminController@update_status');



//ログイン
Auth::routes();
