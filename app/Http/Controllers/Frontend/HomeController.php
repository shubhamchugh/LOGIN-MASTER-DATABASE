<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $limit = 100;

    public function homeList()
    {
        $posts = Post::inRandomOrder()
            ->published()
            ->paginate($this->limit);
        return view('themes.loginVP.content.home', [
            'posts' => $posts,
        ]);
    }

    public function sitemap($sitemap)
    {
        $sitemap = Post::where("slug", "like", "$sitemap%")->paginate($this->limit);
        return view('themes.loginVP.content.sitemap', [
            'sitemap' => $sitemap,
        ]);
    }

    public function search(Request $request)
    {
        return view('themes.loginVP.content.search');
    }
}
