<?php
use App\Http\Controllers\Admin\FinderClinicContoller;


Route::redirect('/', '/login');


// Finder Clinic
Route::get('/finder_clinic', [FinderClinicContoller::class, 'index'])->name('finder_clinic.index');
Route::get('/finder_clinic/search', [FinderClinicContoller::class, 'search'])->name('finder_clinic.search');

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'verified']], function () {
   Route::get('/clinic/approve', function() {
          return view('auth.approve');
        });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'verified', 'checkregistered']], function () {
     
    // Client
    // Appoitment Form
    Route::get('/appointment/form', 'AppointmentController@form')->name('appointment.form');
    // Appoitment Index
    Route::get('/appointment', 'AppointmentController@index')->name('appointment.index');
    // Appoitment Store
    Route::post('/appointment', 'AppointmentController@store')->name('appointment.store');
    // Appoitment Update
    Route::get('/appointment/{appointment}', 'AppointmentController@update')->name('appointment.update');
    // Appoitment Cancel
    Route::delete('/appointment/{appointment}', 'AppointmentController@destroy')->name('appointment.destroy');

    // Clinic
    // Appoitment Index
    Route::get('/clinic/appointments', 'ClinicController@appointments')->name('clinic.appointments');
    Route::get('/clinic/change_status/appointments', 'ClinicController@change_status')->name('clinic.change_status');

    // Doctor Index
    Route::get('/clinic/doctors', 'ClinicController@doctors')->name('clinic.doctors');
    Route::post('/clinic/doctors', 'ClinicController@doctors_store')->name('clinic.doctors_store');
    Route::post('/clinic/doctors/{doctor}', 'ClinicController@doctors_update')->name('clinic.doctors_update');
    Route::get('/clinic/doctors/{doctor}/edit', 'ClinicController@doctors_edit')->name('clinic.doctors_edit');
    Route::delete('/clinic/doctors/{doctor}', 'ClinicController@doctors_destroy')->name('clinic.doctors_destroy');

    // Services Index
    Route::get('/clinic/services', 'ClinicController@services')->name('clinic.services');
    Route::post('/clinic/services', 'ClinicController@services_store')->name('clinic.services_store');
    Route::put('/clinic/services/{service}', 'ClinicController@services_update')->name('clinic.services_update');
    Route::get('/clinic/services/{service}/edit', 'ClinicController@services_edit')->name('clinic.services_edit');
    Route::delete('/clinic/services/{service}', 'ClinicController@services_destroy')->name('clinic.services_destroy');

    //Admin
    Route::get('/clinics', 'AdminController@clinics')->name('clinics.index');
    Route::get('/clients', 'AdminController@clients')->name('clients.index');
    Route::get('/clinics/approved', 'AdminController@approved')->name('clinic.approved');

    // Appoitment Index
    Route::get('/appointments', 'AdminController@appointments')->name('admin.appointments');
    Route::get('/change_status/appointments', 'AdminController@change_status')->name('admin.change_status');

    Route::get('/accounts', 'UsersController@index')->name('accounts.index');
    Route::get('/accounts/{account}/edit', 'UsersController@edit')->name('accounts.edit');
    Route::post('/accounts', 'UsersController@store')->name('accounts.store');
    Route::put('/accounts/{account}', 'UsersController@update')->name('accounts.update');
    Route::delete('/accounts/{account}', 'UsersController@destroy')->name('accounts.destroy');

    //Change Password
    Route::get('/change_password', 'UsersController@changepassword')->name('accounts.changepassword');
    Route::put('/change_password/{user}', 'UsersController@passwordupdate')->name('accounts.passwordupdate');

    //Announcements
    Route::get('/announcements', 'AnnouncementController@index')->name('announcements.index');
    Route::post('/announcements', 'AnnouncementController@store')->name('announcements.store');
    Route::post('/announcements/{announcement}', 'AnnouncementController@update')->name('announcements.update');
    Route::get('/announcements/{announcement}/edit', 'AnnouncementController@edit')->name('announcements.edit');
    Route::delete('/announcements/{announcement}', 'AnnouncementController@destroy')->name('announcements.destroy');


    //MY ACCOUNT
    Route::get('/edit_account',  'UsersController@edit_account')->name('accounts.edit_account');
    Route::post('/edit_account/{account}',  'UsersController@edit_account_update')->name('accounts.edit_account_update');

   
});



