<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function homeList()
    {
        $posts = Post::where('post_ref', config('app.REKEY'))->wherein('id', (getRandomNumberArray(config('app.RANDOM_POST_START_COUNT'), config('app.RANDOM_POST_END_COUNT'), config('app.HOMEPAGE_POST_COUNT'))))
            ->published()
            ->paginate(config('app.HOMEPAGE_POST_COUNT'));
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
