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
        $sidebar = Post::inRandomOrder()->limit(20)->get();

        $View->with([
           'sidebar' => $sidebar,
       ]);
    }
}
