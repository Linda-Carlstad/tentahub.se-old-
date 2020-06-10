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

// Sets app name in URL
Route::get( 'vad-är-' . strtolower( env( 'APP_NAME' ) ), function()
{
    return view( 'general.what-is' );
} )->name( 'what-is' );

// Sets app name in URL
Route::get( 'hur-funkar-' . strtolower( env( 'APP_NAME' ) ), function()
{
    return view( 'general.how-to-use' );
} )->name( 'how-to-use' );

Route::post( '/kontakt-email', 'SendContactRequest' )->name( 'contact' );

Route::get('/linda','FileUploadController@index')->name( 'linda' );

Route::post('/linda', 'FileUploadController@showUploadFile');

// Authentication Routes...
Route::get('logga-in', 'Auth\LoginController@showLoginForm')->name('login-form');
Route::post('login', 'Auth\LoginController@login')->name( 'login' );
Route::post('logga-ut', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('lösenord/återställ', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('lösenord/återställ/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verifiera', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verifiera/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
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
    'users' => 'UserController',
] );

Route::get( 'föreningar', 'AssociationController@index' )->name( 'associations.index' );
Route::get( 'föreningar/skapa', 'AssociationController@create' )->name( 'associations.create' );
Route::get( 'föreningar/{association}', 'AssociationController@show' )->name( 'associations.show' );
Route::get( 'föreningar/{association}/redigera', 'AssociationController@edit' )->name( 'associations.edit' );
Route::post( 'föreningar', 'AssociationController@store' )->name( 'associations.store' );
Route::match( [ 'put', 'patch' ], 'föreningar/{association}', 'AssociationController@update' )->name( 'associations.update' );
Route::delete( 'föreningar/{association}', 'AssociationController@destroy' )->name( 'associations.destroy' );

Route::get( 'kurser', 'CourseController@index' )->name( 'courses.index' );
Route::get( 'kurser/skapa', 'CourseController@create' )->name( 'courses.create' );
Route::get( 'kurser/{course}', 'CourseController@show' )->name( 'courses.show' );
Route::get( 'kurser/{course}/redigera', 'CourseController@edit' )->name( 'courses.edit' );
Route::post( 'kurser', 'CourseController@store' )->name( 'courses.store' );
Route::match( [ 'put', 'patch' ], 'kurser/{course}', 'CourseController@update' )->name( 'courses.update' );
Route::delete( 'kurser/{course}', 'CourseController@destroy' )->name( 'courses.destroy' );


Route::get( 'tentor', 'ExamController@index' )->name( 'exams.index' );
Route::get( 'tentor/skapa', 'ExamController@create' )->name( 'exams.create' );
Route::get( 'tentor/{exam}', 'ExamController@show' )->name( 'exams.show' );
Route::get( 'tentor/{exam}/download', 'ExamController@download' )->name( 'exams.download' );
Route::get( 'tentor/{exam}/redigera', 'ExamController@edit' )->name( 'exams.edit' );
Route::post( 'tentor', 'ExamController@store' )->name( 'exams.store' );
Route::match( [ 'put', 'patch' ], 'tentor/{exam}', 'ExamController@update' )->name( 'exams.update' );
Route::delete( 'tentor/{exam}', 'ExamController@destroy' )->name( 'exams.destroy' );

Route::get( 'universitet', 'UniversityController@index' )->name( 'universities.index' );
Route::get( 'universitet/skapa', 'UniversityController@create' )->name( 'universities.create' );
Route::get( 'universitet/{university}', 'UniversityController@show' )->name( 'universities.show' );
Route::get( 'universitet/{university}/redigera', 'UniversityController@edit' )->name( 'universities.edit' );
Route::post( 'universitet', 'UniversityController@store' )->name( 'universities.store' );
Route::match( [ 'put', 'patch' ], 'universitet/{university}', 'UniversityController@update' )->name( 'universities.update' );
Route::delete( 'universitet/{university}', 'UniversityController@destroy' )->name( 'universities.destroy' );


// Routes using only slugs, placed here to prevent router confusion
Route::get( '{university}/{association}', 'AssociationController@full' )->name( 'associations.full' );
Route::get( '{university}/{course}', 'CourseController@partial' )->name( 'courses.partial' );
Route::get( '{university}/{association}/{course}', 'CourseController@full' )->name( 'courses.full' );
Route::get( '{university}/{association}/{course}/{exam}', 'ExamController@full' )->name( 'exams.full' );
Route::get( '{university}', 'UniversityController@full' )->name( 'universities.full' );
