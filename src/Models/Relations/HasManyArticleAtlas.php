<?php


namespace Tomeet\Cms\Models\Relations;


use App\Services\FileService;

trait HasManyArticleAtlas
{
    public function atlases()
    {
        return $this->hasMany('Tomeet\Cms\Models\ArticleAtlas');
    }

    public static function bootHasManyArticleAtlas()
    {
        static::deleting(function ($model) {
            $atlases = $model->atlases;
            if ($atlases->count()) {
                $atlases->each(function ($atlas) {
                    if ($atlas->image) {
                        (new FileService())->delete($atlas->image);
                    }
                    $atlas->delete();
                });
            };
        });
    }
}
