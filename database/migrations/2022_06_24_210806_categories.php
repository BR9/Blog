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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('sid')->unsigned()->default(0)->comment('Alt kategori ise bağlı olduğu kategori id değerini barındırır.');
            $table->string('category_name', 75);
            $table->bigInteger('created_user')->unsigned()->index()->comment('Kategoriyi oluşturan kullanıcı');
            $table->foreign('created_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
            $table->timestamps();

            $table->charset     =   'utf8mb4';
            $table->collation   =   'utf8mb4_general_ci';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
