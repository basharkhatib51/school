<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('key')->unique()->index();
            $table->text('value')->nullable();
            $table->text('default')->nullable();
            $table->text('option')->nullable();
            $table->enum('type', ['number', 'text', 'string', 'image', 'boolean', 'enum']);
            $table->enum('pack', ['fas', 'fab', 'far', 'feather'])->nullable();
            $table->string('icon')->nullable();
            $table->string('tab');
            $table->integer('index')->nullable();
            $table->audiTable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
