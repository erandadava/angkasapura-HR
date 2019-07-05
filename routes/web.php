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
    return redirect('/login');
});

Route::get('dashboard/hr', 'HomeController@index');

Auth::routes();

Route::resource('users', 'usersController');
Route::resource('jabatanOs', 'jabatan_osController');

Route::get('register/verify', 'Auth\RegisterController@verify')->name('verifyEmailLink');
Route::get('register/verify/resend', 'Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationEmailForm');
Route::post('register/verify/resend', 'Auth\RegisterController@resendVerificationEmail')->name('resendVerificationEmail');

Route::group(['middleware' => ['role:Admin|Super Admin|Vendor|management']], function ()
{
      
    Route::get('/home', 'HomeController@index');

    Route::resource('karyawanOs', 'karyawan_osController');
    
    Route::get('/exportpdf/{table}', 'pdfController@make_pdf');

});

Route::group(['middleware' => ['role:Admin|Super Admin|Vendor']], function ()
{
    Route::get('/formasiexisting', 'unitkerjaController@formasiExisting');

    Route::resource('fungsis', 'fungsiController');
    
    Route::resource('jabatans', 'jabatanController');
    
    Route::resource('karyawans', 'karyawanController');
    
    Route::resource('klsjabatans', 'klsjabatanController');
    
    Route::resource('osdocs', 'osdocController');
    
    Route::resource('statuskars', 'statuskarController');
    
    Route::post('/uploadcsvkaryawan', 'karyawanController@import_from_csv');
    
    Route::post('/uploadcsvkaryawanos', 'karyawan_osController@import_from_csv');
    
    Route::post('/updatepensiun/{id}', 'mppController@update_pensiun');
    
    
    
    
    Route::resource('tipekars', 'tipekarController');
    
    Route::resource('units', 'unitController');
    
    Route::resource('unitkerjas', 'unitkerjaController');
    
    Route::resource('roles', 'rolesController');
    
    Route::resource('mpp', 'mppController');
    
    Route::resource('osperformances', 'OsperformanceController');
    
    Route::resource('fungsiOs', 'fungsi_osController');
    
    Route::resource('vendorOs', 'vendor_osController');
});


Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    \Aschmelyun\Larametrics\Larametrics::routes();
});
