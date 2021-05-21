<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'calendar', 'date', 'horary','team_id_a' ,'gols_a', 'scorers_a','team_id_b' ,'gols_b', 'scorers_b',
    ];

    public function team_a(){
        return $this->belongsTo('App\Models\Team','team_id_a'); 
    }

    public function team_b(){
        return $this->belongsTo('App\Models\Team','team_id_b'); 
    }
}

