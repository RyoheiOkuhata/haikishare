<?php
Auth::routes();


//---------------------------------------
//welcome
//---------------------------------------
Route::get('/', function () {return view('welcome');});

//---------------------------------------
//productController
//---------------------------------------
Route::resource('/products', 'ProductController')->except(['index', 'show'])->middleware('auth');
Route::get('/TopPage', 'ProductController@index')->name('products.index');
Route::resource('/products', 'ProductController')->only(['show']);

//---------------------------------------
//詳細
//---------------------------------------
Route::get('/userProfileDetail/{id}', 'UserController@profileDetail')->name('userProfileDetail');
Route::get('/buyerProfileDetail/{id}','BuyerController@profileDetail')->name('buyerProfileDetail');
Route::get('/soldProductDetail/{id}','UserController@soldProductDetail')->name('soldProductDetail')->middleware('user_check');;

//---------------------------------------
//users
//---------------------------------------
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/person/{id}', 'UserController@person')->name('person')->middleware('user_check');
    Route::get('/{id}/index', 'UserController@index')->name('index')->middleware('user_check');
    Route::get('/onSellProduct/{id}.','UserController@onSellProduct')->name('onSellProducts')->middleware('user_check');
    Route::get('soldProduct/{id}', 'UserController@soldProduct')->name('soldProducts')->middleware('user_check');
    Route::get('/profile/{id}', 'UserController@profile')->name('profile')->middleware('user_check');
    Route::post('/update/{id}', 'UserController@update')->name('update')->middleware('user_check');
    //email表示
    Route::get('email/reset/{id}', 'UserController@emailReset')->name('email.reset')->middleware('user_check');
    //確認emailメール送信
    Route::post('email/reset/{id}', 'UserController@emailResetSendEmail')->name('email.sendemail')->middleware('user_check');
    //完了
    Route::get("emailUpdate/{token}", "UserController@emailUpdate");
    //password表示
    Route::get("password/reset/{id}", "UserController@passwordReset")->name('password.reset')->middleware('user_check');
    //完了
    Route::post("password/update/{id}", "UserController@passwordUpdate")->name('password.update')->middleware('user_check');
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
    Route::get('password/reset/{token}', 'AuthBuyer\ResetPasswordController@showResetForm');
    //パスワードリセット用確定
    Route::post('password/reset', 'AuthBuyer\ResetPasswordController@reset')
    ->name('buyer_auth.password.update');
});

//-------------------------------------
//buyerController
//---------------------------------------
Route::prefix('buyers')->name('buyers.')->group(function () {
    //バイヤーマイーぺージ
    Route::get('index/{id}', 'BuyerController@index')->name('index')->middleware('buyer_auth_check');
    //プロフィールぺージ
    Route::get('profile/{id}', 'BuyerController@profile')->name('profile')->middleware('buyer_auth_check');
    //プロフィールぺージ更新
    Route::post('profile/{id}', 'BuyerController@update')->name('update')->middleware('buyer_auth_check');
    //メールリセットメール送信画面
    Route::get('email/profile/reset/{id}', 'BuyerController@emailReset')->name('email.reset')->middleware('buyer_auth_check');
   //メールリセットメール送信
    Route::post("email/profile/reset/{id}", "BuyerController@emailResetSendEmail")->name('email.sendEmail')->middleware('buyer_auth_check');
   //メールリセットメール完了
    Route::get("emailUpdate/{token}", "BuyerController@emailUpdate");
    //パスワードリセット
    Route::get("password/profile/reset/{id}", "BuyerController@passwordReset")->name('password.reset')->middleware('buyer_auth_check');
    //パスワードリセット完了
    Route::post("password/profile/reset/{id}", "BuyerController@passwordUpdate")->name('password.update')->middleware('buyer_auth_check');
    });

//---------------------------------------
//order
//---------------------------------------
Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('confirm/{id}', 'OrderController@confirmShow')->name('confirmShow');
    Route::post('orderDone/{id}', 'OrderController@orderDone')->name('done');
});




