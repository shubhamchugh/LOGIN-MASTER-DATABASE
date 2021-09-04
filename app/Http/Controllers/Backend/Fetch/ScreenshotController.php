<?php

namespace App\Http\Controllers\Backend\Fetch;

use App\Models\PostContent;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ScreenshotController extends Controller
{
    public function saveImage($start = null, $end = null, $limit = null)
    {
        $postContent = PostContent::where('is_image', 0)->whereBetween('id', [$start, $end])->orderBy('id', 'ASC')->first();

        if (!empty($postContent)) {

            $url = trim($postContent->content_url);
            // an image will be saved
            try {
                $base64Data = Browsershot::url($url)->base64Screenshot();
            } catch (\Throwable $th) {
                PostContent::where('id', $postContent->id)->update([
                    'is_image'      => 1,
                    'content_image' => 'noimage.png',
                ]);
                die("Unable to Take Screenshot");
            }

            //decode base64 string
            $image   = base64_decode($base64Data);
            $png_url = "product-" . time() . ".png";
            Storage::disk('public')->put('screenshot/' . $png_url, $image);

            PostContent::where('id', $postContent->id)->update([
                'is_image'      => 1,
                'content_image' => $png_url,
            ]);
            die("image inserted");

        } else {
            die("No Image Found For Scraping");
        }
    }
}
