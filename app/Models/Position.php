<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','team_id' ,'JJ', 'JG', 'JE','JP','GF','GC','AVG', 'PTS'
    ];

    public function team(){
        return $this->belongsTo('App\Models\Team');
    }
}
