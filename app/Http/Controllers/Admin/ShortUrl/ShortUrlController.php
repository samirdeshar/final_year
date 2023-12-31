<?php
namespace App\Http\Controllers\Admin\ShortUrl;
use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class ShortUrlController extends Controller
{

    public function index()
    {
        return view('admin.shorturl.index');
    }

    public function shorten(Request $request)
    { $request->validate([
        'url' => 'required|url',
    ]);

    $originalUrl = $request->input('url');
    $path = parse_url($originalUrl, PHP_URL_PATH);
    $path = trim($path, '/');
    $segments = explode('/', $path);
    $allButLastSegment = implode('/', array_slice($segments, 0, -1));
    $shortCode = Str::random(5);
    $shortCode =  env('APP_URL').$allButLastSegment.'/'. $shortCode;

    $shortUrlModel = ShortUrl::create([
        'short_code' => $shortCode,
        'original_url' => $originalUrl,
    ]);

    // Construct the short URL for redirection
    $shortUrl = route('shorten.redirect', ['shortCode' => $shortCode]);

    return response()->json([
        'original_url' => $originalUrl,
        'short_url' => $shortUrl,
        'short_url_model' => $shortUrlModel,
    ]);
    }

    public function redirect($shortCode)
    {
        $url = ShortUrl::where('short_code', $shortCode)->first();

        if ($url) {
            return redirect($url->original_url);
        } else {
            // Add logging or debugging statements here
            abort(404, 'Short URL not found');
        }
    }
}
// $path = parse_url($originalUrl, PHP_URL_PATH);
// $path = trim($path, '/');
// $segments = explode('/', $path);
// $lastSegment = end($segments);
// $randomString = Str::random(5);
// dd($randomString);
// $shortCode = Str::slug($lastSegment . $randomString);

// return $shortCode;
