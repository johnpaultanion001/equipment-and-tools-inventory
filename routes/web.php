<?php

Route::redirect('/', '/login');


Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    //Admin
    Route::get('/home', 'AdminController@home')->name('home');


    //Users 
    Route::get('/user', 'UsersController@home')->name('user.home');
    Route::get('/user/offboarding', 'OffBoardingController@offboarding')->name('user.offboarding');
    Route::post('/user/offboarding', 'OffBoardingController@application')->name('user.offboarding.application');

    //Accounts
    Route::get('/accounts', 'UsersController@index')->name('accounts.index');
    Route::get('/accounts/{account}/edit', 'UsersController@edit')->name('accounts.edit');
    Route::post('/accounts', 'UsersController@store')->name('accounts.store');
    Route::put('/accounts/{account}', 'UsersController@update')->name('accounts.update');
    Route::delete('/accounts/{account}', 'UsersController@destroy')->name('accounts.destroy');

    //Change Password
    Route::get('/change_password', 'UsersController@changepassword')->name('accounts.changepassword');
    Route::put('/change_password/{user}', 'UsersController@passwordupdate')->name('accounts.passwordupdate');

    //MY ACCOUNT
    Route::get('/edit_account',  'UsersController@edit_account')->name('accounts.edit_account');
    Route::post('/edit_account/{account}',  'UsersController@edit_account_update')->name('accounts.edit_account_update');

   
});



