<?php

namespace App\Http\Controllers;

use App\Events\RedirectUrl;
use App\Models\Url;
use App\Services\UrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class DashboardController extends Controller
{
    protected $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function index(Request $request)
    {
        $urls = Url::where('id_user', $request->user()->id)->get();
        $urls->map(function ($url) {
            $url->short_url = url($url->short_url);
            return $url;
        });
        return Inertia::render('Dashboard', ['urls' => $urls, 'route_add' => route('add')]);
    }

    public function add()
    {
        return Inertia::render('Add', ['route_save' => route('shorten')]);
    }

    public function redirect(string $shortCode)
    {
        $longUrl = Cache::store("redis")->get($shortCode);

        if(!$longUrl){
            $url = Url::where('short_url', $shortCode)->firstOrFail();
        
            $longUrl = $url->long_url;
    
            Cache::store("redis")->put($shortCode, $longUrl, 120);
        }
        
        RedirectUrl::dispatch();
        return redirect()->away($longUrl);
    }

    public function shorten(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->urlService->save($request->input('longUrl'), $request->user()->id);
            DB::commit();
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard')->with('error', 'An error occurred while shortening the URL.');
        }
    }
}
