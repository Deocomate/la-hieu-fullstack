<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\FacesPlacesAlbum;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class FacesAndPlacesController extends Controller
{
    public function index()
    {
        $page = Cache::rememberForever('page.faces-and-places', fn () => Page::where('key', 'faces-and-places')->firstOrFail());

        $albums = FacesPlacesAlbum::with(['media' => fn ($query) => $query->orderBy('priority')])
            ->published()
            ->ordered()
            ->get();

        return view('client.faces-and-places.index', compact('albums', 'page'));
    }

    public function show($slug)
    {
        $album = FacesPlacesAlbum::with(['media' => fn ($query) => $query->orderBy('priority')])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('client.faces-and-places.detail', compact('album'));
    }
}
