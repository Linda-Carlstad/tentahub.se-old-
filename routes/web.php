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
// Authentication Routes...
Route::get('logga-in', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('lösenord/återställ', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('lösenord/återställ/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verifiera', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verifiera/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify'); // v6.x
Route::get('email/skicka-igen', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('/', function () {
    return view('welcome');
});

Route::get( 'kontakt', function()
{
    return view( 'contacts/info' );
} )->name( 'contacts.info' );

Route::get( 'support/kontakt', function()
{
    return view( 'contacts/support' );
} )->name( 'contacts.support' );

Route::get( 'integritetspolicy', function()
{
    return view( 'policy' );
} )->name( 'policy' );


Route::post( '/contact', 'SendContactRequest' );

Route::get('/linda','FileUploadController@index');

Route::post('/linda', 'FileUploadController@showUploadFile');

Route::group( [ 'middleware' => 'verified' ], function()
{
    Route::get( 'profil/inställningar', 'UserController@edit' )->name( 'profile' );
    Route::match( [ 'put', 'patch' ], '/user/{id}', 'UserController@update' );

    Route::group( [ 'middleware' => 'valid_user' ], function()
    {
        Route::get( 'profil', 'UserController@index' )->name( 'dashboard' );

        Route::group( [ 'middleware' => [ 'moderator' ] ], function()
        {
            Route::resource( 'exam', 'ExamController' );
        } );

        Route::group( [ 'middleware' => [ 'admin' ] ], function()
        {

            Route::resource( 'users', 'UserController' )->only(
            [
                'create', 'store', 'show', 'destroy',
            ] );
            Route::resource( 'admins', 'AdminController' )->only(
            [
                'index', 'edit'
            ] );

        } );

        Route::group( [ 'middleware' => [ 'super' ] ], function()
        {
            Route::get( 'supers', 'SuperController@index' );

            Route::resource( 'admins', 'AdminController' )->only(
            [
                'create', 'store', 'show', 'destroy',
            ] );
        } );
    } );
} );
