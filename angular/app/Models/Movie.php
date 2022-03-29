<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable =[  'title',
                            'episode_id',
                            'opening_crawl',
                            'release_date',
                            'planets',
                            'planets_id',
                            'people',
                            'people_id'];
    protected $table = 'movies';
}
