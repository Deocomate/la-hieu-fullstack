<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index()
    {
        $page = Cache::rememberForever('page.contact', fn () => Page::where('key', 'contact')->firstOrFail());

        return view('client.contact.index', compact('page'));
    }
}
