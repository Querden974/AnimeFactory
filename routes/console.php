<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Schedule as Animes;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



Schedule::command('animes:fetch-last')
->everyFiveMinutes()
->when(function () {
    $day = gmdate("l",time());
    $lastAnime = Animes::where('day', $day)->orderBy('airingAt')->first();

    return time() < $lastAnime->airingAt;
});



// Schedule::command("animes:schedule-fetch")->weekly();


