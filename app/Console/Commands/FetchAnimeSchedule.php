<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Schedule;

class FetchAnimeSchedule extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animes:schedule-fetch';
    // protected $signature = 'app:fetch-anime-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch anime for schedule page';

    /**
     * Execute the console command.
     */
    public function handle()
    {
            $query = <<<GQL
                query (\$page: Int, \$perPage: Int) {
                    Page(page: \$page, perPage: \$perPage) {
                        pageInfo {
                            total
                            perPage
                            currentPage
                            lastPage
                            hasNextPage
                        }
                        media(type: ANIME
                format_in: [TV, ONA]
                status: RELEASING
                licensedBy_in: ["Crunchyroll", "Netflix"]
                isAdult: false
                startDate_greater: 20200101) {
                        id
                        idMal
                        type
                        format
                        episodes
                        duration
                        updatedAt
                        bannerImage
                        coverImage {
                            large
                        }
                        title {
                            romaji
                            english
                        }
                        isLicensed
                        startDate {
                            year
                            month
                            day
                        }
                        streamingEpisodes {
                            title
                            thumbnail
                            url
                            site
                        }
                        nextAiringEpisode {
                            id
                            airingAt
                            timeUntilAiring
                            episode
                            mediaId
                        }
                        }
                    }
                    }


            GQL;

            $variables = [
                'season' => "WINTER",
                'seasonYear' => 2025,
                'page' => 1,
                'perPage' => 50,
                'date'=> 20250101

            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('https://graphql.anilist.co', [
                'query' => $query,
                'variables' => $variables,
            ]);

            $data = $response->json();
            // dd($data);
            // dd(date("l", 1742314776));

            // dd($data);

            $animeList = collect($data['data']['Page']['media'])->map(function ($item){
                if(isset($item['nextAiringEpisode']['airingAt']) && $item['nextAiringEpisode']['airingAt'] !== null){
                    $item["airingDay"] = date("l", $item['nextAiringEpisode']['airingAt']);
                    return $item;
                }
                $item["airingDay"] = "???";
                    return $item;
            });



            foreach ($animeList as $value) {
                $data = $value;
                // echo($value['title']['english']."\n");
                unset($data['id']);
                unset($data['idMal']);
                unset($data['airingDay']);

                $image = isset($data['bannerImage']) && $data['bannerImage'] !== null ? $data['bannerImage'] : $data['coverImage']['large'];

                $current = Schedule::where("animeID", $value['id'])->first();
                if($current !== null){
                    $current->update([
                        'episode' => $value['nextAiringEpisode']['episode'],
                        'img' => $image,
                        'url' => null
                ]);
                } else {

                    $airingAt = isset($value['nextAiringEpisode']['airingAt']) ? $value['nextAiringEpisode']['airingAt'] : null ;
                    if(isset($value['nextAiringEpisode']['airingAt'])){
                        Schedule::create([
                            'animeID'   =>  $value['id'],
                            'malID'     =>  $value['idMal'],
                            'title'     =>  $value['title']['english'],
                            'day'       =>  $value['airingDay'],
                            'episode'   =>  $value['nextAiringEpisode']['episode'],
                            'airingAt'  =>  $airingAt,
                            'data'      =>  json_encode($data)
                        ]);
                    }
                }
            }

    }
}
