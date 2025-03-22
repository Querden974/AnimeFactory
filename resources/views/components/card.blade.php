<div class="card lg:card-side bg-base-100 shadow-sm h-full gap-3  ">

    {{-- <img class="h-auto" src="{{ $anime['images']['webp']['large_image_url'] }}" alt="{{ $anime['title_english'] }}" /> --}}


    <img src="{{ $anime['images']['webp']['large_image_url'] }}" alt="Album" draggable="false" />
    <div class="flex flex-col px-3 gap-3 ">

        <h2 class="card-title">{{ isset($anime['title_english']) ? $anime['title_english'] : $anime['title'] }}</h2>
        @if ($synopsis == 'true')
            <p class="text-xl">{{ str_replace('[Written by MAL Rewrite]', '', $anime['synopsis']) }}</p>
        @else
            <p class="overflow-scroll">{{ str_replace('[Written by MAL Rewrite]', '', $anime['synopsis']) }}</p>
            {{-- <p class="h-fit">{{ mb_strimwidth($anime['synopsis'], 0, 580, '...') }}</p> --}}
        @endif
        <div class="card-actions justify-end">
            {{-- {{ count($anime['licensors']) }} --}}

            <button class="btn btn-primary">Read More</button>

        </div>
    </div>
</div>
