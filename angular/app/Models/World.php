<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class World extends Model
{
    use HasFactory;
    protected $fillable = ['name','rotation_period','orbital_period','diameter','climate','population','films','films_id','people_id','people'];
    protected $table = 'worlds';
}
