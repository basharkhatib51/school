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


Route::namespace('Admin')->group(function () {
    Route::prefix('admins')->group(function () {
        Route::get('/trashed', "AdminController@get_trashed");
        Route::put('/restore/{trashed_admin}', "AdminController@restore");
        Route::post('/change_status/{admin}', "AdminController@change_status");
        Route::post('/change_password/{admin}', "AdminController@change_password");
        Route::post('/change_role/{admin}', "AdminController@change_role");
    });
    Route::resource('admins', "AdminController");
});
Route::namespace('Teacher')->group(function () {
    Route::prefix('teachers')->group(function () {
        Route::get('/trashed', "TeacherController@get_trashed");
        Route::put('/restore/{trashed_teacher}', "TeacherController@restore");
        Route::post('/change_status/{teacher}', "TeacherController@change_status");
        Route::post('/change_password/{teacher}', "TeacherController@change_password");
    });
    Route::resource('teachers', "TeacherController");
});
//Route::namespace('Family')->group(function () {
//    Route::prefix('families')->group(function () {
//        Route::get('/trashed', "FamilyController@get_trashed");
//        Route::put('/restore/{trashed_family}', "FamilyController@restore");
//        Route::post('/change_status/{family}', "FamilyController@change_status");
//        Route::post('/change_password/{family}', "FamilyController@change_password");
//    });
//    Route::resource('families', "FamilyController");
//});
Route::namespace('Student')->group(function () {
    Route::prefix('students')->group(function () {
        Route::get('/trashed', "StudentController@get_trashed");
        Route::put('/restore/{trashed_student}', "StudentController@restore");
        Route::post('/change_status/{student}', "StudentController@change_status");
        Route::post('/change_password/{student}', "StudentController@change_password");
    });
    Route::resource('students', "StudentController");
});

Route::namespace('Role')->group(function () {
    Route::get('permissions', "RoleController@permissions");
    Route::resource('role', "RoleController");
});

Route::namespace('Page')->group(function () {
    Route::get('pages/trashed', "PageController@get_trashed");
    Route::put('pages/restore/{trashed_page}', "PageController@restore");
    Route::resource('pages', "PageController");
});
Route::namespace('Post')->group(function () {
    Route::get('posts/trashed', "PostController@get_trashed");
    Route::put('posts/restore/{trashed_post}', "PostController@restore");
    Route::resource('posts', "PostController");
});
Route::namespace('Menu')->group(function () {
    Route::get('menus/trashed', "MenuController@get_trashed");
    Route::put('menus/restore/{trashed_menu}', "MenuController@restore");
    Route::resource('menus', "MenuController");
});
Route::namespace('Tag')->group(function () {
    Route::get('tags/trashed', "TagController@get_trashed");
    Route::put('tags/restore/{trashed_tag}', "TagController@restore");
    Route::resource('tags', "TagController");
});
    Route::get('analytics', "DashboardController@index");
//vue-cli-service lint --fix
