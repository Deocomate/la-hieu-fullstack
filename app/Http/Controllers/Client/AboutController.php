<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class AboutController extends Controller
{
    public function index()
    {
        $page = Cache::rememberForever('page.about', fn () => Page::where('key', 'about')->firstOrFail());

        return view('client.about.index', compact('page'));
    }
}
