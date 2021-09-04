<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('themes.loginVP.content.post',
            [
                'post' => $post,
            ]);
    }
}
