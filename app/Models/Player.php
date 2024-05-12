<?php

namespace App\Models;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula',
        'cedula_photo',
        'name',
        'dorsal',
        'photo',
        'team_id',
    ];

    public function team(){
        return $this->belongsTo(Team::class);
    }
}
