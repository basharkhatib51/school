<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('model_number')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('user_type',['admin','teacher','student','family'])->default('admin');
            $table->enum('status',['active','deactivated','blocked'])->default('active');
            $table->text('blocked_reason')->nullable()->default('Please Active your Email First.');
            $table->string('phone')->nullable();
            $table->string('password');
            $table->enum('language', ['english', 'arabic', 'turkish'])->default('arabic');

            $table->rememberToken();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->audiTable();
            $table->foreignId('family_id')->nullable()->constrained('users');
            $table->unique('family_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
