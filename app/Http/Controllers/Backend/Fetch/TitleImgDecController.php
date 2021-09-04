<?php

namespace App\Http\Controllers\Backend\Fetch;

use App\Http\Controllers\Controller;
use App\Models\PostContent;
use Illuminate\Support\Facades\Http;

class TitleImgDecController extends Controller
{
    public function TitleImgDec($start = null, $end = null)
    {
        $url = PostContent::where('is_image', '0')->whereBetween('id', [$start, $end])->orderBy('id', 'ASC')->first();

        if (!empty($url)) {
            $url->update([
                'is_image' => '1',
            ]);

            $apiUrl = 'http://apiserver.test/TitleImgDec?url=' . $url->content_url;

            $response    = Http::get($apiUrl);
            $response    = $response->body();
            $response    = json_decode($response, true);
            $mainText    = (!empty($response['main_text']['text'])) ? $response['main_text']['text'] : "";
            $description = (!empty($response['description'])) ? $response['description'] : "";
            $description = $description . $mainText;

            $title       = (!empty($response['title'])) ? ($response['title']) : "Not Available";
            $description = (strlen($description) > 200) ? substr($description, 0, 200) . '...' : $description;
            $description = (!empty($description)) ? $description : "Not Available";
            $imageName   = (!empty($response['imageName'])) ? $response['imageName'] : "noimage.png";

            $url->update([
                'content_title' => $title,
                'content_dec'   => $description,
                'content_image' => $imageName,
            ]);

            echo "Post updated";
        } else {
            dd("AlL Url Scraped Please check DataBase And Stop Scraping");
        }
    }
}
