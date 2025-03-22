<?php
date_default_timezone_set('Europe/Paris');
// dd($info);
$dateStamp = $info['airingAt'];
$url = $url = route('anime.show', ['malId' => $info['malID']]);
$day = gmdate("l",time());



if (time() >= $dateStamp && $info['url'] !== null) {
        $url = $info['url'];
    }

$currentEpisode = $info['episode'];


?>

<a href="{{ $url }}">
    <div
        class="grid grid-rows-1 grid-cols-1 gap-3 w-full rounded-md border-2  text-sm relative cursor-pointer
        {{ time() >= $dateStamp ? 'border-green-400  hover:text-green-300' : 'border-red-400 hover:text-red-300' }}">
        <p
            class="row-start-1 col-start-1 w-full z-10 bg-base-100/75 h-fit mt-auto text-center  truncate px-3 rounded-b-sm">
            {{ $info['title'] }}
        </p>
        @if (isset($dateStamp))
            <p class="absolute right-0 bg-base-100 px-1 rounded-tr-sm rounded-bl-sm">
                {{ gmdate('H:i', $dateStamp) }}</p>
        @else
            <p class="absolute right-0 bg-base-100 px-1 rounded-tr-sm rounded-bl-sm">
                END </p>
        @endif
        <p class="absolute left-0 bg-base-100 px-1 rounded-tl-sm rounded-br-sm">
            {{ $currentEpisode }} </p>

        <div class=" w-full overflow-clip row-start-1 col-start-1 ">
            <img src="{{ $info['img'] }}" alt="" class="w-full h-[78px] object-cover rounded-sm">
        </div>
    </div>
</a>
