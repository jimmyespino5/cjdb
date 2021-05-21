<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'image', 'price', 'location','typeservices_id','teacher'
    ];

    public function type(){
        return $this->belongsTo('App\Models\TypeService','typeservices_id');
    }
}
