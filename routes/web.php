<?php

Route::redirect('/', '/login');


Auth::routes();

Route::post('/registration', 'RegistrationController@store')->name('registration.store');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    //Admin
    Route::get('/home', 'AdminController@home')->name('home');
    // Route::resource('email', 'RegisterEmailController');

    
    Route::get('/master_list', 'RegistrationController@master_list')->name('master_list');
    Route::get('/registration', 'RegistrationController@index')->name('registration');
    Route::get('/registration/{id}', 'RegistrationController@show')->name('registration.show');
    Route::post('/registration/{id}', 'RegistrationController@store')->name('registration.store');
    Route::post('/registration/{id}/declined', 'RegistrationController@declined')->name('registration.declined');

    Route::get('/applications', 'ApplicationController@index')->name('index');
    Route::get('/applications/{application}', 'ApplicationController@full_details')->name('full_details');
    Route::get('/applications/{application}/status', 'ApplicationController@status')->name('status');
    Route::post('/applications/{application}/status', 'ApplicationController@set_status')->name('set_status');


    //Users 
    Route::get('/user', 'UsersController@home')->name('user.home');
    Route::get('/user/offboarding', 'OffBoardingController@offboarding')->name('user.offboarding');
    Route::post('/user/offboarding', 'OffBoardingController@application')->name('user.offboarding.application');
    Route::put('/user/offboarding/receive_status', 'OffBoardingController@receive_status')->name('user.receive_status.application');
    Route::post('/user/offboarding/answer_video', 'OffBoardingController@answer_video')->name('user.answer_video.application');

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



