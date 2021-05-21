<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'color','logo','sport',
    ];

    public function players(){
        return $this->hasMany('App\Models\Player','team_id'); 
    }

    public function position(){
        return $this->hasOne('App\Models\Position');
    }

    public function result_a(){
        return $this->hasOne('App\Models\Result','team_id_a');
    }

    public function result_b(){
        return $this->hasOne('App\Models\Result','team_id_b');
    }
    
}
