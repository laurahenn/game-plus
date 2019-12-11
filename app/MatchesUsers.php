<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MatchesUsers extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['id', 'value','play','pay','userId', 'matchId'];
    
    public function user()
    {
        return $this->belongsTo('App\Users');
    }

    public function matche()
    {
        return $this->belongsTo('App\Matches');
    }

}