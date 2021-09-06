<?php

namespace App\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class SidebarView
{
    public function compose(View $view)
    {
        $this->composeSidebar($view);
    }

    public function composeSidebar(View $View)
    {
        $post         = Post::get();
        $postFirst_id = Post::orderBy('id')->pluck('id')->first();
        $postCount    = $post->count();
        $sidebar      = Post::published()->where('post_ref', config('app.REKEY'))->wherein('id', (getRandomNumberArray($postFirst_id, $postCount, config('app.SIDEBAR_POST_COUNT'))))->get();

        $View->with([
            'sidebar' => $sidebar,
        ]);
    }
}
