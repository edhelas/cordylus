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

Route::get('/', 'ShootingController@welcome')->name('welcome');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('shootings', 'Admin\ShootingController');
    Route::resource('models', 'Admin\ModelController');
    Route::resource('shootings.photos', 'Admin\ShootingPhotoController');
    Route::get('shootings/{shooting}/photos/{photo}/primary', 'Admin\ShootingPhotoController@setPrimary')->name('shootings.photos.primary');
    Route::get('shootings/{shooting}/photos/{photo}/publish', 'Admin\ShootingPhotoController@publish')->name('shootings.photos.publish');
    Route::get('shootings/{shooting}/photos/{photo}/unpublish', 'Admin\ShootingPhotoController@unpublish')->name('shootings.photos.unpublish');

    Route::get('shootings/{shooting}/photos/{photo}/exclusive', 'Admin\ShootingPhotoController@setExclusive')->name('shootings.photos.exclusive');
    Route::get('shootings/{shooting}/photos/{photo}/unexclusive', 'Admin\ShootingPhotoController@unsetExclusive')->name('shootings.photos.unexclusive');

    Route::get('shootings/{shooting}/photos/{photo}/remove', 'Admin\ShootingPhotoController@destroy')->name('shootings.photos.remove');
    Route::post('shootings/{shooting}/models/add', 'Admin\ShootingModelController@create')->name('shootings.models.add');
    Route::get('shootings/{shooting}/models/{model}/remove', 'Admin\ShootingModelController@destroy')->name('shootings.models.remove');
});

Route::get('g/', 'ShootingController@index')->name('shootings.gallery');
Route::get('h/{hash}', 'Admin\ShootingModelController@show')->name('shooting.model.show.hash');
Route::get('s/{slug}/{hash?}', 'ShootingController@show')->name('shootings.show.slug');

# Model
Route::get('m/{slug}', 'ModelController@show')->name('models.show.slug');
Route::post('m/{hash}', 'Admin\ModelPhotoController@create')->name('models.photos.create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
