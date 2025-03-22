<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'animeID',
        'malID',
        'day',
        'data',
        'title',
        'airingAt',
        'episode',
        'url',
        'img'
    ];
}
