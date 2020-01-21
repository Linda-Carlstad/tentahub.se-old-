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


Route::get( '/', 'ShowDashboard' )->name( 'dashboard' );

Route::get( 'kontakt', function()
{
    return view( 'contacts.info' );
} )->name( 'contacts.info' );

Route::get( 'support/kontakt', function()
{
    return view( 'contacts.support' );
} )->name( 'contacts.support' );

Route::get( 'integritetspolicy', function()
{
    return view( 'general.policy' );
} )->name( 'policy' );

Route::get( 'om-oss', function()
{
    return view( 'general.about' );
} )->name( 'about' );

Route::get( 'vad-är-' . strtolower( env( 'APP_NAME' ) ), function()
{
    return view( 'general.what-is' );
} )->name( 'what-is' );

Route::get( 'hur-funkar-' . strtolower( env( 'APP_NAME' ) ), function()
{
    return view( 'general.how-to-use' );
} )->name( 'how-to-use' );

Route::post( '/contact', 'SendContactRequest' )->name( 'contact' );

Route::get('/linda','FileUploadController@index')->name( 'linda' );

Route::post('/linda', 'FileUploadController@showUploadFile');

// Authentication Routes...
Route::get('logga-in', 'Auth\LoginController@showLoginForm')->name('login-form');
Route::post('login', 'Auth\LoginController@login')->name( 'login' );
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

Route::group( [ 'middleware' => 'verified' ], function()
{
    Route::get( 'profil/inställningar', 'UserController@settings' )->name( 'profile.settings' );
    Route::match( [ 'put', 'patch' ], '/user/{id}', 'UserController@update' );

    Route::group( [ 'middleware' => 'valid_user' ], function()
    {
        Route::get( 'profil', 'UserController@profile' )->name( 'profile' );
    } );
} );

Route::resources(
[
    'admins' => 'AdminController',
    'associations' => 'AssociationController',
    'courses' => 'CourseController',
    'exams' => 'ExamController',
    'universities' => 'UniversityController',
    'users' => 'UserController',
    'supers' => 'SuperController',
] );

Route::get( 'exams/{exam}/download', 'ExamController@download' )->name( 'exams.download' );
