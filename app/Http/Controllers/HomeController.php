<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Jobs\FetchAnimeDataJob;
use Illuminate\Support\Facades\Date;
use App\Models\Schedule;


class HomeController extends Controller
{
    public function index()
    {
        $url = "https://api.jikan.moe/v4/top/anime?limit=5";
        $data = file_get_contents($url);
        $animes = json_decode($data, true)["data"];
        // dd($json);
        return view('base', compact('animes'));
    }
    public function top()
    {
        $url = "https://api.jikan.moe/v4/top/anime?limit=9";
        $data = file_get_contents($url);
        $animes = json_decode($data, true)["data"];
        // dd($json);
        return view('topAnime', compact('animes'));
    }

    public function schedule()
    {
        $order = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        $animeList = Schedule::all()->toArray();
        $animeList = collect($animeList)->groupBy("day");

        $animeList = $animeList->sortBy(function($value, $key) use ($order) {
            return array_search($key, $order);
        });

    return view('schedule', compact('animeList'));
    }


    public function anime($malId = null)
    {
        if(!$malId) {
            return response()->json(['error' => 'Mal Id is required'], 400);
        }

            $animeData = [];
            $query = <<<GQL
                query (\$id: Int) {
                Media(idMal: \$id, type: ANIME) {
                    id
                    idMal
                    title {
                    romaji
                    english
                    }
                    coverImage {
                    large
                    }
                    bannerImage
                    genres
                    seasonYear
                    season
                    description
                }
                }
                GQL;

            $variables = [
                'id' => $malId,
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('https://graphql.anilist.co', [
                'query' => $query,
                'variables' => $variables,
            ]);

            $data = $response->json()['data']['Media'];

            return view('anime', compact('data'));

    }
}
