<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Game extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['name','nPlayers','nTeams','time'];

    protected $dates = ['deleted_at'];
    
}
