<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Match extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['name','timeStart','lati','long', 'pin', 'value', 'ownerId', 'gameId'];

    protected $dates = ['deleted_at'];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

}