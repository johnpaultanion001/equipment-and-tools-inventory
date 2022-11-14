<?php

Route::redirect('/', '/admin/dashboard');


Auth::routes();


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    
    //Admin
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('events', 'EventController');
    Route::get('/events/is_open/{event}', 'EventController@isopen')->name('events.isopen');
    Route::get('/members', 'AdminController@members')->name('members');
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('/dashboard/{event_id}', 'AdminController@dashboard_event')->name('dashboard_event');
    
    Route::resource('sponsors', 'SponsorController');
    Route::post('sponsors/update/{sponsor}', 'SponsorController@update_sponsor')->name('sponsors.update_sponsor');

    Route::resource('budgets', 'BudgetController');
    //Members 
    Route::get('/user/events', 'UsersController@events')->name('user.events');
    Route::get('/user/events/{event}', 'UsersController@store_event')->name('user.store_event');
    Route::get('/user/{event}', 'UsersController@event')->name('user.event');
    Route::get('/users/history', 'UsersController@history')->name('user.history');
    Route::get('/users/account/{user}', 'UsersController@account')->name('user.account');
    Route::put('/users/account/{user}', 'UsersController@update_account')->name('user.update_account');
    Route::put('/users/pass/{user}', 'UsersController@update_pass')->name('user.update_pass');
});



