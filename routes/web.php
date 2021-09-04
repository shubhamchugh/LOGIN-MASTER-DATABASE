<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\StaticPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

# ########################################################## #
# ##################### API & Scraping settings Route ##################### #
# ########################################################## #
// API Controller ResetCount
Route::get('reset', [
    'uses' => 'App\Http\Controllers\ResetCountCheckController@reset',
    'as'   => 'reset.index',
]);

// API Controller scrape Data
Route::get('hit', [
    'uses' => 'App\Http\Controllers\ApiDataScrapeController@hit',
    'as'   => 'hit.index',
]);

// Insert Fake database
Route::get('insert', [
    'uses' => 'App\Http\Controllers\FakeDataInsert@insert',
    'as'   => 'insert.index',
]);
# ########################################################## #
# ##################### Frontend Route ##################### #
# ########################################################## #

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Frontend Product Page
Route::get('changeSlugOrRemove/{post}', [
    'uses' => 'App\Http\Controllers\Frontend\PostController@show',
    'as'   => 'post.show',
]);

//Frontend Home Page
Route::get('/', [
    'uses' => 'App\Http\Controllers\Frontend\HomeController@homeList',
    'as'   => 'index',
]);

///Frontend Home Page
Route::get('/page/{page} ', [
    'uses' => 'App\Http\Controllers\Frontend\PageController@show',
    'as'   => 'page.show',
]);

Route::get('/sitemap/{sitemap}', [
    'uses' => 'App\Http\Controllers\Frontend\HomeController@sitemap',
    'as'   => 'sitemap.show',
]);

Route::get('/search', [
    'uses' => 'App\Http\Controllers\Frontend\HomeController@search',
    'as'   => 'search.show',
]);

Route::get('/docs/{page}', StaticPageController::class)->name('docs')->where('page', 'about|contact|terms|privacy|dmca');

# ######################################################### #
# ##################### Backend Route ##################### #
# ######################################################### #

// Back End Page Routes //
Route::resource('/content', 'App\Http\Controllers\Backend\PageManagement\PageController');

Route::put('/content/restore/{content}', [
    'uses' => 'App\Http\Controllers\Backend\PageManagement\PageController@restore',
    'as'   => 'content.restore',
]);
Route::delete('/content/force-destroy/{content}', [
    'uses' => 'App\Http\Controllers\Backend\PageManagement\PageController@forceDestroy',
    'as'   => 'content.force-destroy',
]);

// Back End Post Routes //
Route::resource('logins', 'App\Http\Controllers\Backend\PostManagement\PostController');

Route::get('/postcontent/add/{post_id} ', [
    'uses' => 'App\Http\Controllers\Backend\PostManagement\PostContentController@AddPostContent',
    'as'   => 'postcontent.add',
]);

Route::resource('postcontent', 'App\Http\Controllers\Backend\PostManagement\PostContentController');

Route::put('/logins/restore/{logins}', [
    'uses' => 'App\Http\Controllers\Backend\PostManagement\PostController@restore',
    'as'   => 'logins.restore',
]);

Route::delete('/logins/force-destroy/{logins}', [
    'uses' => 'App\Http\Controllers\Backend\PostManagement\PostController@forceDestroy',
    'as'   => 'logins.force-destroy',
]);

// Back End user Routes //
Route::resource('user', 'App\Http\Controllers\Backend\User\UsersController');

Route::get('user/confirm/{users}', [
    'uses' => 'App\Http\Controllers\Backend\User\UsersController@confirm',
    'as'   => 'user.confirm',
]);

// Scraping //
Route::resource('scraping', 'App\Http\Controllers\Backend\Settings\ScrapingPageController');

Route::get('scrape/base64/start/{start}/end/{end}/limit/{limit}', [
    'uses' => 'App\Http\Controllers\Backend\Fetch\ScrapeBase64Controller@ScrapeBase64',
    'as'   => 'scrape.base64',
]);

Route::get('scrape/onlyurltitle/start/{start}/end/{end}/limit/{limit}', [
    'uses' => 'App\Http\Controllers\Backend\Fetch\OnlyUrlTitleScrapeController@OnlyUrlTitle',
    'as'   => 'scrape.onlyurltitle',
]);

Route::get('scrape/TitleImgDec/start/{start}/end/{end}/', [
    'uses' => 'App\Http\Controllers\Backend\Fetch\TitleImgDecController@TitleImgDec',
    'as'   => 'scrape.TitleImgDec',
]);

Route::get('scrape/imageformat/start/{start}/end/{end}/limit/{limit}', [
    'uses' => 'App\Http\Controllers\Backend\Fetch\ScrapeImageFormat@ScrapeImageFormat',
    'as'   => 'scrape.base64',
]);

Route::get('scrape/images/start/{start}/end/{end}/limit/{limit}', [
    'uses' => 'App\Http\Controllers\Backend\Fetch\ScreenshotController@saveImage',
    'as'   => 'scrape.saveImage',
]);

Route::get('scrape/metadata/start/{start}/end/{end}/limit/{limit}', [
    'uses' => 'App\Http\Controllers\Backend\Fetch\MetadataController@saveMetadata',
    'as'   => 'scrape.saveMetadata',
]);

// Settings //
Route::resource('settings', 'App\Http\Controllers\Backend\Settings\BasicConfiguration');
