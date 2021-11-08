<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_category_id')->comment('分类ID');
            $table->string('title')->comment('文章标题');
            $table->string('color')->nullable()->comment('文章标题');
            $table->string('cover')->nullable()->comment('封面图片');
            $table->string('subtitle')->nullable()->comment('副标题');
            $table->string('abstract')->nullable()->comment('内容摘要');
            $table->string('source')->nullable()->comment('文章来源');
            $table->string('author')->nullable()->comment('文章作者');
            $table->string('linkurl')->nullable()->comment('跳转链接');
            $table->unsignedTinyInteger('is_annex')->nullable()->default(0)->comment('是否有附件');
            $table->unsignedTinyInteger('is_video')->nullable()->default(0)->comment('是否是视频');
            $table->unsignedTinyInteger('is_atlas')->nullable()->default(0)->comment('是否是图库');
            $table->unsignedTinyInteger('is_linkurl')->nullable()->default(0)->comment('是否跳转');
            $table->unsignedTinyInteger('is_allow_comment')->nullable()->default(0)->comment('是否允许评论');
            $table->unsignedTinyInteger('is_top')->nullable()->default(0)->comment('是否置顶');
            $table->unsignedTinyInteger('is_hot')->nullable()->default(0)->comment('是否热门');
            $table->timestamp('publish_at')->nullable()->comment('发布时间');
            $table->timestamp('expired_at')->nullable()->comment('下架时间');
            $table->timestamps();

            $table->index('article_category_id');
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
