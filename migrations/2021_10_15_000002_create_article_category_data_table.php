<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCategoryDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_category_data', function (Blueprint $table) {
            $table->id();
            $table->integer('article_category_id')->unsigned();
            $table->string('title')->comment('标题');
            $table->text('content')->comment('内容详情');

            $table->index('article_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_category_data');
    }
}
