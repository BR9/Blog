<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('logo', 100);
            $table->longText('description');
            $table->longText('analytics')->nullable();
            $table->tinyInteger('maintance')->default(2);
            $table->timestamps();

            $table->charset     =   'utf8mb4';
            $table->collate     =   'utf8mb4_general_ci';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
};
