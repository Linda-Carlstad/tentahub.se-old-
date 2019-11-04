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

Auth::routes( [ 'verify' => true ] );

Route::get('/', function () {
    return view('welcome');
});

Route::get('/linda', 'FileController@index');
Route::get('/download', 'FileController@download');
Route::get('/show', 'FileController@show');

Route::post('/linda', 'FileController@store');

Route::group( [ 'middleware' => 'verified' ], function()
{
    Route::get( 'profil', 'UserController@index' )->name( 'dashboard' );
    Route::get( 'profil/inställningar', 'UserController@edit' )->name( 'profile' );
    Route::match( [ 'put', 'patch' ], '/user/{id}', 'UserController@update' );

    Route::group( [ 'middleware' => [ 'moderator' ] ], function()
    {
        Route::resource( 'exam', 'ExamController' );
    } );

    Route::group( [ 'middleware' => [ 'admin' ] ], function()
    {
        Route::resource( 'user', 'UserController' )->only(
        [
            'create', 'store', 'show',
        ] );
        Route::resource( 'admin', 'AdminController' )->only(
        [
            'index',
        ] );

    } );

    Route::group( [ 'middleware' => [ 'super' ] ], function()
    {
        Route::get( 'super', 'SuperController@index' );

        Route::resource( 'user', 'UserController' )->only(
        [
            'destroy',
        ] );

        Route::resource( 'admin', 'AdminController' )->only(
        [
            'create', 'store', 'show', 'destroy',
        ] );
    } );
} );
