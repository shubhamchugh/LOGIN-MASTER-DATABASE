<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\FakeUser;
use App\Models\CountCheck;
use App\Models\PostContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiDataScrapeController extends Controller
{
    public function hit(Request $request)
    {
        $start   = $request->start;
        $end     = $request->end;
        $postRef = $request->refkey;
        $site    = $request->site;

        $count = CountCheck::where('is_scraped', '0')->whereBetween('id', [$start, $end])->orderBy('id', 'ASC')->first();

        if (!empty($count->id)) {

            $site = $site . '/api/' . $count->id;

            $totalUsers = FakeUser::count();

            $response = Http::get($site);
            $response = $response->json();

            if ($response['status']) {
                $title     = $response['title'];
                $sourceUrl = $response['source_url'];

                $postCreate = Post::Create([
                    'post_title'   => $title,
                    'source_url'   => $sourceUrl,
                    'post_ref'     => $postRef,
                    'fake_user_id' => mt_rand(1, $totalUsers),

                ]);

                foreach ($response['postContent'] as $key => $value) {
                    $contentTitle = $value['content_title'];
                    $contentUrl   = $value['content_url'];
                    $contentDec   = $value['content_dec'];
                    $contentImage = $value['content_image'];

                    $postContent = PostContent::create([
                        'post_id'       => $postCreate->id,
                        'content_title' => $contentTitle,
                        'content_url'   => $contentUrl,
                        'content_dec'   => $contentDec,
                        'content_image' => $contentImage,
                        'fake_user_id'  => mt_rand(1, $totalUsers),
                    ]);

                    $count->update(
                        [
                            'is_scraped' => '1',
                        ]
                    );
                }
            } else {
                dd("status is false Something Bad With API DATA");
            }

        } else {
            dd("Already Scraped Data please Stop Scraping");
        }

    }
}
