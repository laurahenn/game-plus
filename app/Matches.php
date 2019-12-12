<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Matches extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['id','name','dateStart','timeStart','latitu','longitu', 
                            'pin', 'value', 'ownerId', 'gameId'];

    public function owner()
    {
        return $this->belongsTo('App\Users');
    }

    public function game()
    {
        return $this->belongsTo('App\Games');
    }

}