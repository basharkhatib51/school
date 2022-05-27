<?php

use Illuminate\Support\Str;

$Routes = [
    'Subject', 'Classroom', 'Payment', 'Exam', 'Message', 'Program'
];
$FullRoutes = [
    'Fee', 'Notification', 'Year'
];
Route::post('subjects/filter', "SubjectController@filter");
Route::post('classrooms/filter', "ClassroomController@filter");

Route::get('subject_registration/trashed', "SubjectRegistrationController@get_trashed");
Route::put('subject_registration/restore/{trashed_subject_registration}', "SubjectRegistrationControllerController@restore");
Route::resource('subject_registrations', "SubjectRegistrationController");

Route::get('student_registration/trashed', "StudentRegistrationController@get_trashed");
Route::put('student_registration/restore/{trashed_student_registration}', "StudentRegistrationController@restore");
Route::resource('student_registrations', "StudentRegistrationController");

Route::get('class_level/trashed', "ClassLevelController@get_trashed");
Route::put('class_level/restore/{trashed_class_level}', "ClassLevelController@restore");
Route::resource('class_levels', "ClassLevelController");

foreach ($FullRoutes as $route) {
    Route::get(Str::plural(Str::lower($route)) . '/trashed', $route . "Controller@get_trashed");
    Route::put(Str::plural(Str::lower($route)) . '/restore/' . '{trashed_' . Str::lower($route) . '}', $route . "Controller@restore");
    Route::resource(Str::plural(Str::lower($route)), $route . "Controller");
}
foreach ($Routes as $route) {
    Route::resource(Str::plural(Str::lower($route)), $route . "Controller");
}
