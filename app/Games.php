<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\DB;

class Games extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['id', 'name','nPlayers','nTeams','time'];    
}