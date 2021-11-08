<?php

namespace Tomeet\Cms\Http\Controllers\Admin;

use Tomeet\Cms\Http\Controllers\Controller;
use Tomeet\Cms\Models\ArticleAtlas;
use Illuminate\Http\Request;

class ArticleAtlasController extends Controller
{
    //
    public function destroy($id)
    {
        $atlas = ArticleAtlas::findOrFail($id);
        $atlas->delete();
    }
}
