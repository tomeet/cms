<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleAnnexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_annexes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('article_id')->unsigned();
            $table->string('filename')->nullable()->comment('文件名称');
            $table->string('filepath')->nullable()->comment('文件地址');
            $table->string('extension')->nullable()->comment('文件扩展');
            $table->string('mine_type')->nullable()->comment('文件类型');
            $table->string('size')->nullable()->comment('文件大小');
            $table->integer('downloads')->unsigned()->nullable()->default(0)->comment('下载量');
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
        Schema::dropIfExists('article_annexes');
    }
}
