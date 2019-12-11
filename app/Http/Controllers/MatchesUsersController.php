<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MatchesUsers;

class MatchesUsersController extends Controller
{
    public function index()
    {
        return MatchesUsers::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['id'] = (DB::table('matches_users')->max('id'))+1;

        $obj = MatchesUsers::create($data);

        $return = MatchesUsers::find($data['id']);        
        return $return;
    }

    public function show($id)
    {
        return MatchesUsers::find($id); 
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        MatchesUsers::find($id)->update($data);

        $return = MatchesUsers::find($id);     
        return $return;
    }

    public function destroy($id)
    {
        MatchesUsers::find($id)->delete();
        return 'success';
    }
}
