<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class VideographyController extends Controller
{
    public function index()
    {
        $page = Cache::rememberForever('page.videography', fn () => Page::where('key', 'videography')->firstOrFail());

        $articles = Article::with('category')
            ->published()
            ->where('type', 'videography')
            ->ordered()
            ->paginate(10);

        return view('client.videography.index', [
            'articles' => $articles,
            'page' => $page,
            'cardLayout' => 'hover',
        ]);
    }

    public function show($slug)
    {
        $article = Article::with('category')
            ->published()
            ->where('type', 'videography')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('client.videography.detail', compact('article'));
    }
}
