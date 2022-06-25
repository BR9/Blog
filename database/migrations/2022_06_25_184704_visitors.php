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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_id')->unsigned()->index()->comment('Bağlı olduğu blog');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade')->onUpdate('no action');
            $table->string('visitor_id', 125)->comment('Sisteme giriş yapan her kullanıcının özel parmak izi numarası');
            $table->timestamps();

            $table->charset         =   'utf8mb4';
            $table->collate         =   'utf8mb4_general_ci';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
};
