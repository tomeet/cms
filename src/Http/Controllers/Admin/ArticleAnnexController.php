<?php

namespace Tomeet\Cms\Http\Controllers\Admin;

use Tomeet\Cms\Http\Controllers\Controller;
use Tomeet\Cms\Models\ArticleAnnex;

class ArticleAnnexController extends Controller
{
    //
    public function destroy($id)
    {
        $annex = ArticleAnnex::findOrFail($id);
        $annex->delete();
    }
}
