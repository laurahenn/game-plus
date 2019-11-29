<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class MatchUser extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['value','play','pay','userId', 'matcheId'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function matche()
    {
        return $this->belongsTo('App\Match');
    }

}
