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
    return view('auth.login');
});



Auth::routes();

Route::resource('users', 'usersController');

Route::get('register/verify', 'Auth\RegisterController@verify')->name('verifyEmailLink');
Route::get('register/verify/resend', 'Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationEmailForm');
Route::post('register/verify/resend', 'Auth\RegisterController@resendVerificationEmail')->name('resendVerificationEmail');
Route::group(['middleware' => ['web', 'auth', 'isEmailVerified']], function ()
{

});
Route::get('/home', 'HomeController@index');

Route::resource('fungsis', 'fungsiController');

Route::resource('jabatans', 'jabatanController');

Route::resource('karyawans', 'karyawanController');

Route::resource('klsjabatans', 'klsjabatanController');

Route::resource('osdocs', 'osdocController');

Route::resource('statuskars', 'statuskarController');







Route::resource('tipekars', 'tipekarController');

Route::resource('units', 'unitController');

Route::resource('unitkerjas', 'unitkerjaController');

Route::resource('roles', 'rolesController');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    \Aschmelyun\Larametrics\Larametrics::routes();
});