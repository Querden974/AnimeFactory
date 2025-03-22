<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Schedule;

class FetchLastEpisode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animes:fetch-last';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Last Episode of target anime';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $day = gmdate("l",time());
        $daily = Schedule::where('day', $day)->get();
        $list = collect($daily)->map(function ($item){
            return $item->malID;
        });

       $query = <<<GQL
                query (\$ids: [Int]) {
                    Page {
                        media(idMal_in: \$ids) {
                            id
                            idMal
                            streamingEpisodes {
                                title
                                thumbnail
                                url
                                site
                            }
                        }
                    }

                }
            GQL;

            $variables = [
                'ids' => $list,
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('https://graphql.anilist.co', [
                'query' => $query,
                'variables' => $variables,
            ]);

            $data = $response->json()['data']['Page']['media'];
            $data = collect($data)->filter(function ($item){
                return count($item['streamingEpisodes']) > 0;
            });

            foreach ($data as $value) {
                $current = Schedule::where("malID", $value['idMal'])->first();
                if(time() >= $current->airingAt){
                    $current->update([
                        'url' => $value['streamingEpisodes'][0]['url']
                    ]);
                }
            }
    }
}
