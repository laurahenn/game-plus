<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Games extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['name','nPlayers','nTeams','time'];

    protected $dates = ['deleted_at'];
    
}