<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique()->comment('分类名称');
            $table->unsignedTinyInteger('type')->default(0)->comment('栏目类型：0：栏目， 1：单页');
            $table->string('alias')->unique('栏目别名')->comment('栏目别名');
            $table->string('image')->nullable()->comment('栏目图片');
            // 嵌套集模型，无限级分类，nestedset扩展，增加了三个字段：_lft _rgt parent_id ,类型 int 长度10
            $table->nestedSet();
            $table->tinyInteger('sort')->nullable()->default(0)->comment('排序');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();

            $table->index('title');
            $table->index('alias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_categories');
    }
}
