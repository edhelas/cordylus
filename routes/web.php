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

    Route::get('user/edit', 'Admin\UserController@edit')->name('user.edit');
    Route::put('user', 'Admin\UserController@update')->name('user.update');

    // Photos
    Route::get('shootings/{shooting}/photos/publish_all', 'Admin\ShootingPhotoController@publishAll')->name('shootings.photos.publish_all');
    Route::resource('shootings.photos', 'Admin\ShootingPhotoController');
    Route::get('shootings/{shooting}/photos/{photo}/primary', 'Admin\ShootingPhotoController@setPrimary')->name('shootings.photos.primary');
    Route::get('shootings/{shooting}/photos/{photo}/publish', 'Admin\ShootingPhotoController@publish')->name('shootings.photos.publish');
    Route::get('shootings/{shooting}/photos/{photo}/unpublish', 'Admin\ShootingPhotoController@unpublish')->name('shootings.photos.unpublish');
    Route::get('shootings/{shooting}/photos/{photo}/up', 'Admin\ShootingPhotoController@moveUp')->name('shootings.photos.up');
    Route::get('shootings/{shooting}/photos/{photo}/down', 'Admin\ShootingPhotoController@moveDown')->name('shootings.photos.down');

    Route::get('shootings/{shooting}/photos/{photo}/exclusive', 'Admin\ShootingPhotoController@setExclusive')->name('shootings.photos.exclusive');
    Route::get('shootings/{shooting}/photos/{photo}/unexclusive', 'Admin\ShootingPhotoController@unsetExclusive')->name('shootings.photos.unexclusive');
    Route::get('shootings/{shooting}/photos/{photo}/remove', 'Admin\ShootingPhotoController@destroy')->name('shootings.photos.remove');
    Route::post('shootings/{shooting}/models/add', 'Admin\ShootingModelController@create')->name('shootings.models.add');

    // Videos
    Route::resource('shootings.videos', 'Admin\ShootingVideoController');
    Route::get('shootings/{shooting}/videos/{video}/publish', 'Admin\ShootingVideoController@publish')->name('shootings.videos.publish');
    Route::get('shootings/{shooting}/videos/{video}/unpublish', 'Admin\ShootingVideoController@unpublish')->name('shootings.videos.unpublish');

    Route::get('shootings/{shooting}/videos/{video}/exclusive', 'Admin\ShootingVideoController@setExclusive')->name('shootings.videos.exclusive');
    Route::get('shootings/{shooting}/videos/{video}/unexclusive', 'Admin\ShootingVideoController@unsetExclusive')->name('shootings.videos.unexclusive');

    Route::get('shootings/{shooting}/models/{model}/remove', 'Admin\ShootingModelController@destroy')->name('shootings.models.remove');
});

Route::get('feed', 'ShootingController@feed')->name('shootings.feed');
Route::get('g/', 'ShootingController@index')->name('shootings.gallery');
Route::get('h/{hash}', 'Admin\ShootingModelController@show')->name('shooting.model.show.hash');
Route::get('s/{slug}/{hash?}', 'ShootingController@show')->name('shootings.show.slug');

# Author
Route::get('a/{slug}', 'AuthorController@show')->name('authors.show.slug');

# Model
Route::get('m', 'ModelController@index')->name('models.index');
Route::get('m/{slug}', 'ModelController@show')->name('models.show.slug');
Route::post('m/{hash}', 'Admin\ModelPhotoController@create')->name('models.photos.create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'AuthorController@about')->name('about');
