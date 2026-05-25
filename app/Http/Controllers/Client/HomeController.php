<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\EventAlbum;
use App\Models\FacesPlacesAlbum;
use App\Models\Page;
use App\Models\Partner;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $page = Cache::rememberForever('page.home', fn () => Page::where('key', 'home')->firstOrFail());

        $eventAlbums = EventAlbum::published()
            ->where('is_featured', true)
            ->ordered()
            ->take(4)
            ->get();

        $facesAlbums = FacesPlacesAlbum::with(['media' => fn ($query) => $query->orderBy('priority')])
            ->published()
            ->ordered()
            ->take(4)
            ->get();

        $pjArticles = Article::with('category')
            ->published()
            ->where('type', 'photojournalism')
            ->where('is_featured', true)
            ->ordered()
            ->take(5)
            ->get();

        $videoArticles = Article::with('category')
            ->published()
            ->where('type', 'videography')
            ->ordered()
            ->take(5)
            ->get();

        $partners = Partner::published()
            ->ordered()
            ->get();

        return view('client.home.index', compact(
            'eventAlbums',
            'facesAlbums',
            'page',
            'partners',
            'pjArticles',
            'videoArticles',
        ));
    }
}
