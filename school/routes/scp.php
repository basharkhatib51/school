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

Route::namespace('Scp')->group(function () {
    Route::get('student_result', "ScpController@student_result");
    Route::get('student_subject', "ScpController@student_subjects");
    Route::get('notifications', "ScpController@get_notifications");
    Route::get('student_program', "ScpController@student_program");
    Route::get('last_years', "ScpController@last_years");
    Route::get('messages/{subject_registration}', "ScpController@messages");
    Route::post('send_message/{subject_registration}', "ScpController@send_message");
    Route::post('send_file_message/{subject_registration}', "ScpController@send_file_message");
});
