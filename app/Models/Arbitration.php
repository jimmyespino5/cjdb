<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbitration extends Model
{
    use HasFactory;

    protected $fillable = [
        'journeys',
        'team_id',
        'solvent',
    ];
}
