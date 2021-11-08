<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleAtlasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_atlases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('article_id')->unsigned();
            $table->string('title')->nullable()->comment('文件名称');
            $table->string('image')->nullable()->comment('文件地址');
            $table->string('description')->nullable()->comment('文件扩展');
            $table->integer('likes')->unsigned()->nullable()->default(0)->comment('点赞量');
            $table->timestamps();

            //外键约束
            $table->index('article_id');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_atlases');
    }
}
