<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable =[
        'journey_id',
        'team_a_id',
        'goals_a',
        'team_b_id',
        'goals_b',
        'date'
    ];

    
}
