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

Route::namespace('Tcp')->group(function () {
    Route::get('exam/{exam}', "TcpController@get_exam");
    Route::post('update_result/{exam}', "TcpController@update_result");
    Route::post('update_results/{exam}', "TcpController@update_results");
    Route::get('programs', "TcpController@get_programs");
    Route::get('subject_registrations', "TcpController@get_subject_registrations");
    Route::get('subject_registration/{subject_registration}', "TcpController@get_subject_registration");
    Route::get('messages/{subject_registration}', "TcpController@messages");
    Route::put('change_chat_status/{subject_registration}', "TcpController@change_chat_status");
    Route::post('create_exam', "TcpController@create_exam");
    Route::delete('delete_exam/{exam}', "TcpController@delete_exam");
    Route::post('send_message/{subject_registration}', "TcpController@send_message");
    Route::post('send_file_message/{subject_registration}', "TcpController@send_file_message");
    Route::get('analytics', "TcpController@analytics");
});
