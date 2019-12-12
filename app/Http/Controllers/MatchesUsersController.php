<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MatchesUsers;

class MatchesUsersController extends Controller
{
    public function index()
    {
        $matches_users = MatchesUsers::all();

        if (!$matches_users) {
            return [ 'success' => false, 'matches_users' => '' ];
        }
        return [ 'success' => true, 'matches_users' => $matches_users ];
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['id'] = (DB::table('matches_users')->max('id'))+1;

        $obj = MatchesUsers::create($data);
        if (!$obj) {
            return [ 'success' => false, 'match_user' => '' ];
        }

        $return = MatchesUsers::find($data['id']);        
        return [ 'success' => true, 'match_user' => $return ];
    }

    public function show($id)
    {
        $match_user = MatchesUsers::find($id); 
        if (!$match_user) {
            return [ 'success' => false, 'match_user' => '' ];
        }
        return [ 'success' => true, 'match_user' => $match_user ];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $obj = MatchesUsers::find($id)->update($data);

        if (!$obj) {
            return [ 'success' => false, 'match_user' => '' ];
        }
        
        $return = MatchesUsers::find($id);     
        return [ 'success' => true, 'match_user' => $return ];
    }

    public function destroy($id)
    {
        $match_user = MatchesUsers::find($id);
        if (!$match_user) {
            return [ 'success' => false ];
        }

        $match_user->delete();
        return [ 'success' => true ];      
    }
}
