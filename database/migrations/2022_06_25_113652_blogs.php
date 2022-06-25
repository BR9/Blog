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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned()->index()->comment('Bağlı olduğu kategori');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('no action');
            $table->string('blog_title', 100);
            $table->longText('blog_content');
            $table->string('blog_img', 100)->nullable();
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
        Schema::dropIfExists('blogs');
    }
};
