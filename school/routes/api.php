<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('authorize')->namespace('Authenticate')->group(function () {
//    Route::get('{provider}/redirect', 'SocialAuthController@redirectToProvider')->name('api.social.redirect');
//    Route::get('{provider}/callback', 'SocialAuthController@handleProviderCallback')->name('api.social.callback');

    Route::post('/login', "AuthenticateController@login");
//    Route::post('/forget_password', "AuthenticateController@forget_password");
//    Route::post('/reset_password', "AuthenticateController@reset_password");
//    Route::post('/check_code', "AuthenticateController@check_code");
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', "AuthenticateController@logout");
        Route::post('/get_auth', "AuthenticateController@get_auth");
        Route::post('/change_password', "AuthenticateController@change_password");
        Route::post('/update_profile', "AuthenticateController@update_profile");
    });
});
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('upload')->namespace('Upload')->group(function () {
        Route::delete('delete_file/{file}', "UploadController@delete_file");
        Route::post('file', "UploadController@upload_file");
        Route::post('image_or_file', "UploadController@upload_image_or_file");
        Route::post('image', "UploadController@upload_image");
        Route::post('base64', "UploadController@base64");
        Route::get('image/{upload}', "UploadController@image");
    });
});
Route::prefix('home')->namespace('Home')->group(function () {
    Route::get('menu_elements', "HomeController@menu_elements");
    Route::get('posts', "HomeController@posts");
    Route::get('post/{post}', "HomeController@post");
    Route::get('page/{page}', "HomeController@page");
    Route::post('contact_us', "HomeController@contact_us");
});
//vue-cli-service lint --fix
