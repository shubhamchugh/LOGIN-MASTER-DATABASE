<?php

namespace App\Http\Controllers\Backend\Fetch;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostContent;
use App\Models\ScrapingFailed;
use App\Models\SourceUrl;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ScrapeBase64Controller extends Controller
{
    public function ScrapeBase64($start = null, $end = null, $limit = null)
    {
        $source_url = SourceUrl::where('is_scraped', 0)->whereBetween('id', [$start, $end])->orderBy('id', 'ASC')->first();

        if (!empty($source_url->url)) {
            //is_scraped Updated in database before insert
            $source_url->update(['is_scraped' => 1]);

            //duplicate check in database before insert

            $duplicate_check = Post::where('source_url', $source_url->url)->first();
            if (empty($duplicate_check)) {
                echo "$source_url->url";
                $response = Http::get($source_url->url);
                $response = $response->body();

                $pokemon_doc = new \DOMDocument();
                libxml_use_internal_errors(true); //disable libxml errors

                $pokemon_doc->loadHTML($response);
                libxml_clear_errors(); //remove errors for yucky html

                $pokemon_doc->preserveWhiteSpace = false;
                $pokemon_doc->saveHTML();

                $pokemon_xpath = new \DOMXPath($pokemon_doc);

                //get all the data with an id
                $titles      = $pokemon_xpath->query('/html/body/div[1]/div/div[1]/div[2]/div[*]/div/div/div[1]/a/img/@alt');
                $decs        = $pokemon_xpath->query('/html/body/div[1]/div/div[1]/div[2]/div[*]/div/div/div[2]/div[3]/text()');
                $imgs        = $pokemon_xpath->query('/html/body/div[1]/div/div[1]/div[2]/div[*]/div/div/div[1]/a/img/@src');
                $urls        = $pokemon_xpath->query('/html/body/div[1]/div/div[1]/div[2]/div[*]/div/div/div[2]/h3/a/@href');
                $posts_title = $pokemon_xpath->query('/html/body/div[1]/div/div[1]/div[1]/div[1]/div[1]/h1');

                if (1 == $posts_title->length) {
                    foreach ($posts_title as $post_title) {
                        $post_name[] = $post_title->nodeValue;
                    }
                    echo "<pre>";
                    print_r($post_name);

                    foreach ($titles as $title) {
                        $result_title2[] = $title->nodeValue;
                    }
                    echo "<pre>";
                    print_r($result_title2);
                    foreach ($decs as $dec) {
                        $result_dec[] = $dec->nodeValue;
                    }
                    echo "<pre>";
                    print_r($result_dec);

                    foreach ($urls as $url) {
                        $result_url[] = $url->nodeValue;
                    }

                    print_r($result_url);
                    $i = 0;
                    foreach ($imgs as $img) {

                        $image = $img->nodeValue; // your base64 encoded
                        $image = trim($image);
                        $image = str_replace('data:image/png;base64,', '', $image);
                        $image = str_replace('data:image/jpg;base64,', '', $image);
                        $image = str_replace('data:image/jpeg;base64,', '', $image);
                        $image = str_replace('data:image/gif;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);

                        $image = base64_decode($image);

                        $imageName    = Str::slug($result_title2[$i], '-') . '.' . 'png';
                        $imageArray[] = $imageName;
                        Storage::disk('wasabi')->put($imageName, $image);
                        $i++;
                    }

                    echo "<pre>";
                    print_r($imageArray);
                } else {

                    ScrapingFailed::create([
                        'source_url' => $source_url->url,
                        'error'      => '404 Not Found',
                    ]);

                    die("404 Data Not Found");
                }

                $post_name = str_replace('Login', ' ', $post_name[0]);

                $startdate = strtotime("2021-3-01 00:00:00");
                $enddate   = strtotime("2021-5-31 23:59:59");

                $randomDate = date("Y-m-d H:i:s", rand($startdate, $enddate));

                $postStore = Post::create([
                    'is_content'   => '1',
                    'post_title'   => $post_name,
                    'source_url'   => $source_url->url,
                    //'fake_user_id' => rand(1,175,424),
                    'fake_user_id' => rand(1, 175424),
                    'published_at' => $randomDate,
                ]);

                for ($i = 0; $i < $titles->length; $i++) {

                    PostContent::create([
                        'post_id'       => $postStore->id,
                        'fake_user_id'  => rand(1, 175424),
                        //'fake_user_id'=> '1',
                        'content_title' => $result_title2[$i],
                        'content_url'   => $result_url[$i],
                        'content_dec'   => $result_dec[$i],
                        'is_image'      => 1,
                        'content_image' => $imageArray[$i],
                    ]);
                }

            } else {
                ScrapingFailed::create([
                    'source_url' => $source_url->url,
                    'error'      => 'Duplicate Removed From DataBase Id:' . $source_url->id,
                ]);
                SourceUrl::findorfail($source_url->id)->delete();
                die("duplicate record deleted from database");
            }

            die("scraped success");

        } else {
            die("No Record Found Please Stop Scraping");
        }
    }
}
