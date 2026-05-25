<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PhotojournalismController extends Controller
{
    public function index()
    {
        $page = Cache::rememberForever('page.photojournalism', fn () => Page::where('key', 'photojournalism')->firstOrFail());

        $articles = Article::with('category')
            ->published()
            ->where('type', 'photojournalism')
            ->ordered()
            ->paginate(10);

        return view('client.photojournalism.index', compact('articles', 'page'));
    }

    public function show($slug)
    {
        $article = Article::with([
            'category',
            'media' => fn ($query) => $query->orderBy('priority'),
        ])
            ->published()
            ->where('type', 'photojournalism')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('client.photojournalism.detail', compact('article'));
    }
}
