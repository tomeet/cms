<?php

use Illuminate\Support\Facades\Route;
use Tomeet\Cms\Http\Controllers\Admin\CategoryController;
use Tomeet\Cms\Http\Controllers\Admin\ArticleController;
use Tomeet\Cms\Http\Controllers\Admin\ArticleAnnexController;
use Tomeet\Cms\Http\Controllers\Admin\ArticleAtlasController;

/**
 * 内容管理（CMS）
 */
Route::prefix('admin/api')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        Route::prefix('cms')->name('cms.')->group(function () {
            // 分类管理
            Route::get('categories/existence/check', [CategoryController::class, 'exists'])->name('categories.exists.check');
            Route::put('categories/{category}/sort', [CategoryController::class, 'setSort'])->name('categories.set.sort');
            Route::put('categories/{category}/data', [CategoryController::class, 'setData'])->name('categories.set.data');
            Route::get('categories/{category}/data', [CategoryController::class, 'getData'])->name('categories.get.data');

            // 文章管理
            Route::delete('articles', [ArticleController::class, 'massDestroy'])->name('articles.destroy.batch');

            // 文章附件
            Route::delete('annexes/{annex}', [ArticleAnnexController::class, 'destroy'])->name('articles.annexes.destroy');
            Route::delete('atlases/{atlas}', [ArticleAtlasController::class, 'destroy'])->name('articles.atlases.destroy');
            Route::apiResources([
                'categories' => CategoryController::class,
                'articles' => ArticleController::class
            ]);
        });
    });
});
