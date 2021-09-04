<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function show(Page $page)
    {
        return view('themes.loginVP.content.page',
            [
                'page' => $page,
            ]);
    }
}
