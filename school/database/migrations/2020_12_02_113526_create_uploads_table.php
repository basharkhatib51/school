<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->text('generated_name');
            $table->text('original_name');
            $table->text('real_path')->nullable();
            $table->string('extension');
            $table->string('size');
            $table->string('mime_type');
            $table->string('type');
            $table->audiTable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('avatar_id')->nullable()->constrained('uploads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
