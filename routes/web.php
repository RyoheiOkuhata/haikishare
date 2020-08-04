<?php
Auth::routes();


Route::get('/welcome', function () {return view('welcome');});

//---------------------------------------
//productController
//---------------------------------------
Route::resource('/products', 'ProductController')->except(['index', 'show'])->middleware('auth');
Route::get('/', 'ProductController@index')->name('products.index');
Route::resource('/products', 'ProductController')->only(['show']);


//---------------------------------------
//users
//---------------------------------------
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/person/{id}', 'UserController@person')->name('person')->middleware('auth');
    Route::get('/profile/{id}', 'UserController@profile')->name('profile')->middleware('auth');
    Route::post('/update/{id}', 'UserController@update')->name('update')->middleware('auth');
    Route::post('/{id}', 'UserController@confirmGive')->name('confirmGive')->middleware('auth');
    Route::get('/{id}/confirmGet', 'UserController@confirmGet')->name('confirmGet')->middleware('auth');
    Route::post('/{id}/done', 'UserController@done')->name('done')->middleware('auth');
    Route::get('/{id}/index', 'UserController@index')->name('index')->middleware('auth');
    Route::get('/onSellProduct/{id}.','UserController@onSellProduct')->name('onSellProducts')->middleware('auth');
    Route::get('soldProduct/{id}', 'UserController@soldProduct')->name('soldProducts')->middleware('auth');
    //email表示
    Route::get('email/reset/{id}', 'UserController@emailReset')->name('email.reset')->middleware('auth');
    //emailメール送信
    Route::post('email/reset/{id}', 'UserController@emailUpdate')->name('email.update')->middleware('auth');
    //完了
    Route::get("reset/{token}", "UserController@reset")->middleware('auth');
    //password表示
    Route::get("password/reset/{id}", "UserController@passwordReset")->name('password.reset')->middleware('auth');
    //完了
    Route::post("password/update/{id}", "UserController@passwordUpdate")->name('password.update')->middleware('auth');
});
//---------------------------------------
//buyerAuthController
//---------------------------------------

Route::group(['prefix' => 'buyers'], function () {
    Route::get('register', 'AuthBuyer\RegisterController@showRegistrationForm')
    ->name('buyer_auth.register');
    Route::post('register', 'AuthBuyer\RegisterController@create')
    ->name('buyer_auth.create');
    Route::get('login','AuthBuyer\LoginController@showLoginForm')
    ->name('buyer_auth.login');
    Route::post('login', 'AuthBuyer\LoginController@login')
    ->name('buyer_auth.login');
    Route::post('logout', 'AuthBuyer\LoginController@logout')
    ->name('buyer_auth.logout');
    //パスワードリセット用メール送信画面
    Route::get('password/reset', 'AuthBuyer\ForgotPasswordController@showLinkRequestForm')
    ->name('buyer_auth.password.request');
    //パスワードリセット用メール送信
    Route::post('password/email', 'AuthBuyer\ForgotPasswordController@sendResetLinkEmail')
    ->name('buyer_auth.password.email');
    //パスワードリセット用確定画面
    Route::get('password/reset/{token}', 'AuthBuyer\ResetPasswordController@showResetForm')
    ->name('buyer_auth.password.reset');
    //パスワードリセット用確定
    Route::post('password/reset', 'AuthBuyer\ResetPasswordController@reset')
    ->name('buyer_auth.password.update');
});

//-------------------------------------
//buyerController
//---------------------------------------
//buyer_auth_check

Route::prefix('buyers')->name('buyers.')->group(function () {
    //バイヤーマイーぺージ
    Route::get('{id}/index', 'BuyerController@index')->name('index')->middleware('buyer_auth_check');
    //プロフィールぺージ
    Route::get('{id}', 'BuyerController@show')->name('show')->middleware('buyer_auth_check');
    //プロフィールぺージ更新
    Route::post('{id}', 'BuyerController@update')->name('update')->middleware('buyer_auth_check');
    //プロフィールメールリセットメール送信画面
    Route::get('email/profile/reset/{id}', 'BuyerController@emailReset')->name('email.reset')->middleware('buyer_auth_check');
   //プロフィールメールリセットメール送信
    Route::post("email/profile/reset/{id}", "BuyerController@emailUpdate")->name('email.update')->middleware('buyer_auth_check');
   //プロフィールメールリセットメール完了
    Route::get("reset/{token}", "BuyerController@reset")->middleware('buyer_auth_check');
    //プロフィールパスワードリセット
    Route::get("password/profile/reset/{id}", "BuyerController@passwordReset")->name('password.reset')->middleware('buyer_auth_check');
    //プロフィールパスワードリセット完了
    Route::post("password/profile/reset/{id}", "BuyerController@passwordUpdate")->name('password.update')->middleware('buyer_auth_check');
    });


//---------------------------------------
//order
//---------------------------------------
Route::prefix('orders')->name('orders.')->group(function () {
    Route::post('/{id}', 'OrderController@confirmGive')->name('confirmGive')->middleware('buyer_auth_check');
    Route::get('/{id}/confirmGet', 'OrderController@confirmGet')->name('confirmGet')->middleware('buyer_auth_check');
    Route::post('/{id}/done', 'OrderController@done')->name('done')->middleware('buyer_auth_check');
});




