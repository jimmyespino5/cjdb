<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Tournament extends Model
{
    use HasFactory;
 
    protected $fillable =[
        'name',
        'teams',
        'date',
        'available',
        'groups',
        'registration',
    ];

    public function equipos(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_tournament', 'tournament_id', 'team_id');
    }

    public function team($id)
    {
        return Team::where('id',$id);
    }

    public function equipoInscrito($id)
    {
        if ($this->belongsToMany(Team::class, 'team_tournament', 'tournament_id', 'team_id')->where('team_id',$id)->count() > 0) {
            return true;
        }
        return false;
    }

    public function teams_group()
    {
        //dd($this->id);
        return Team::select('teams.*','groups.group')
                    ->join('groups','groups.team_id','teams.id')
                    ->where('groups.tournament_id',$this->id)        
        ;  
    }

    
}
