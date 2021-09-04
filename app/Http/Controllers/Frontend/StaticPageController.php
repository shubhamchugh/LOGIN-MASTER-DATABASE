<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticPageController extends Controller
{
    public function __invoke()
    {
        return view('themes.loginVP.content.staticpage.' . request()->segment(2));
    }
}
