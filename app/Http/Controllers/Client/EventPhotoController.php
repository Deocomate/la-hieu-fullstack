<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\EventAlbum;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class EventPhotoController extends Controller
{
    public function index()
    {
        $page = Cache::rememberForever('page.event-photos', fn () => Page::where('key', 'event-photos')->firstOrFail());

        $albums = EventAlbum::with(['media' => fn ($query) => $query->orderBy('priority')])
            ->published()
            ->ordered()
            ->get();

        return view('client.event-photos.index', compact('albums', 'page'));
    }

    public function show($slug)
    {
        $album = EventAlbum::with(['media' => fn ($query) => $query->orderBy('priority')])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('client.event-photos.detail', compact('album'));
    }
}
