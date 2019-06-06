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

Route::get('/', 'HomeController@welcome');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('shootings', 'Admin\ShootingController');
    Route::resource('models', 'Admin\ModelController');
    Route::resource('shootings.photos', 'Admin\ShootingPhotoController');
    Route::get('shootings/{shooting}/photos/{photo}/remove', 'Admin\ShootingPhotoController@destroy')->name('shootings.photos.remove');
    Route::post('shootings/{shooting}/models/add', 'Admin\ShootingModelController@create')->name('shootings.models.add');
    Route::get('shootings/{shooting}/models/{model}/remove', 'Admin\ShootingModelController@destroy')->name('shootings.models.remove');
});

Route::get('m/{slug}', 'ModelController@show')->name('models.show.slug');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
