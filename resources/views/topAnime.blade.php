@extends('base')
@section('title', 'Top Anime')

@section('content')
    <div class=" flex items-center  my-3 text-3xl ">
        <h1 class=" font-bold ">Top Anime -</h1>
        <select class=" w-fit">
            <option class="bg-base-300" value="overall" selected>Overall</option>
            @for ($i = 2025; $i > 2000; $i -= 5)
                <option class="bg-base-300" value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>


    <div id="content" class="grid grid-cols-2 gap-3">

        @foreach ($animes as $anime)
            @if ($loop->index == 0)
                <div id="mainNews" class="col-span-2  h-96 rounded-t-xl p-1">
                    {{-- {{ dd($animes[0]['title_english']) }} --}}
                    <x-card :anime="$anime" synopsis=true />
                </div>
            @else
                <div id="subNews1" class=" h-64 rounded-bl-xl">
                    <x-card :anime="$anime" synopsis=false />
                </div>
            @endif
        @endforeach
    </div>

@endsection
