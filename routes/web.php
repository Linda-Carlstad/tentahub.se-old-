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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/linda','FileUploadController@index');

Route::post('/linda', 'FileUploadController@showUploadFile');

Route::group( [ 'middleware' => 'verified' ], function()
{
    Route::get( 'profil', 'UserController@index' )->name( 'dashboard' );
    Route::get( 'profil/inställningar', 'UserController@edit' )->name( 'profile' );
} );


Route::group( [ 'middleware' => [ 'admin' ] ], function()
{
    Route::get( 'admin', 'AdminController@index' );
} );

Route::group( [ 'middleware' => [ 'super' ] ], function()
{
    Route::get( 'super', 'SuperController@index' );
} );
