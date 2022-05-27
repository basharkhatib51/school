<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('subject_registrations', function (Blueprint $table) {
            $table->foreignId('subject_id')->nullable()->constrained('subjects');
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms');
            $table->foreignId('teacher_id')->nullable()->constrained('users');
            $table->unique(['teacher_id', 'classroom_id','subject_id']);
        });

        Schema::table('student_registrations', function (Blueprint $table) {
            $table->foreignId('student_id')->nullable()->constrained('users');
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms');
            $table->unique(['student_id', 'classroom_id']);
        });


        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreignId('year_id')->nullable()->constrained('years');
            $table->foreignId('class_level_id')->nullable()->constrained('class_levels');
            $table->unique(['name', 'year_id','class_level_id']);
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->foreignId('class_level_id')->nullable()->constrained('class_levels');
            $table->unique(['name', 'class_level_id','semester']);
        });

        Schema::table('fees', function (Blueprint $table) {
            $table->foreignId('class_level_id')->nullable()->constrained('class_levels');
            $table->foreignId('year_id')->nullable()->constrained('years');
            $table->unique(['class_level_id', 'year_id']);
        });


        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('student_registration_id')->nullable()->constrained('student_registrations');
        });

        Schema::table('results', function (Blueprint $table) {
            $table->foreignId('student_id')->nullable()->constrained('users');
            $table->foreignId('exam_id')->nullable()->constrained('exams');
            $table->unique(['student_id', 'exam_id']);
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->foreignId('subject_registration_id')->nullable()->constrained('subject_registrations');
            $table->unique(['subject_registration_id', 'type']);

        });

        Schema::create('class_level_notification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->nullable()->constrained('notifications');
            $table->foreignId('class_level_id')->nullable()->constrained('class_levels');
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->nullable()->constrained('posts');
            $table->foreignId('tag_id')->nullable()->constrained('tags');
            $table->unique(['post_id', 'tag_id']);
        });
        Schema::create('page_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->nullable()->constrained('pages');
            $table->foreignId('tag_id')->nullable()->constrained('tags');
            $table->unique(['page_id', 'tag_id']);
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('student_id')->nullable()->constrained('users');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('teacher_id')->nullable()->constrained('users');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('subject_registration_id')->nullable()->constrained('subject_registrations');
        });

        Schema::table('programs', function (Blueprint $table) {
            $table->foreignId('subject_registration_id')->nullable()->constrained('subject_registrations');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
