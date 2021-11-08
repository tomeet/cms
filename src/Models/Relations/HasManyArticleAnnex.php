<?php


namespace Tomeet\Cms\Models\Relations;


use App\Services\FileService;

trait HasManyArticleAnnex
{
    public function annexes()
    {
        return $this->hasMany('Tomeet\Cms\Models\ArticleAnnex');
    }

    public static function bootHasManyArticleAnnex()
    {
        static::deleting(function ($model) {
            $annexes = $model->annexes;
            if ($annexes->count()) {
                $annexes->each(function ($annex) {
                    if ($annex->filepath) {
                        (new FileService())->delete($annex->filepath);
                    }
                    $annex->delete();
                });
            };
        });
    }
}
