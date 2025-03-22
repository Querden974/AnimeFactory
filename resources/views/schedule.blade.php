@extends('base')
@section('title', 'Schedule')

@section('content')


    {{-- @dd($animeList) --}}

    <div class="flex flex-row gap-3 w-full justify-evenly mt-3">
        @foreach ($animeList as $day => $animes)
            <div class="flex flex-col h-min p-1 gap-3  {{ $day === date('l') ? 'bg-gray-200/25 rounded-sm' : '' }}">
                <h2 class="text-xl font-bold capitalize text-center underline">{{ $day }}</h2>
                <div class="flex flex-col w-56 gap-3">

                    <?php
                    $animes = collect($animes)->sort(function ($a, $b) {
                        $dateA = isset(json_decode($a['data'])->nextAiringEpisode->airingAt) ? json_decode($a['data'])->nextAiringEpisode->airingAt : 0;
                        $dateB = isset(json_decode($b['data'])->nextAiringEpisode->airingAt) ? json_decode($b['data'])->nextAiringEpisode->airingAt : 0;

                        return $dateA - $dateB;
                    });
                    // dd($animes);
                    ?>

                    @foreach ($animes as $anime)
                        <x-anime-card :info="$anime" />
                    @endforeach
                </div>

            </div>
        @endforeach
    </div>

@endsection
