<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'lastname','birthday','number','age','gols','play','team_id',
    ];

    public function team(){
        return $this->belongsTo('App\Models\Team','team_id');
    }
}
