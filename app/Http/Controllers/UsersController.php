<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Users;
use App\MatchesUsers;
use App\Matches;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();

        if (!$users) {
            return [
                'success' => false,
                'users' => ''
            ];
        }

        return [
            'success' => true,
            'users' => $users
        ];
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['id'] = (DB::table('users')->max('id'))+1;

        $obj = Users::create($data);
        if (!$obj) {
            return [ 'success' => false, 'user' => '' ];
        }

        $return = Users::find($data['id']);        
        return [ 'success' => true, 'user' => $return ];
    }

    public function show($id)
    {
        $user = Users::find($id); 

        $user['nMatches'] = MatchesUsers::where('userId', '=', $id)->count();
        $user['nGames'] = MatchesUsers::where('userId', '=', $id)->where('play','=',true)->count();
        $user['nFaulty'] = MatchesUsers::where('userId', '=', $id)->where('play','=',false)->count();
        $user['totalPay'] = MatchesUsers::where('userId', '=', $id)->where('pay','=',true)->sum('value');
        $user['nCreate'] = Matches::where('ownerId', '=', $id)->count();

        // "nMatches": 0,   // Jogos inscrito
        // "nGames": 0,     // Jogos jogados
        // "nFaulty": 0,    // Jogos faltados
        // "totalPay": 0,   // Total já pago
        // "nCreate": 0,    // Número de jogos criados

        if (!$user) {
            return [ 'success' => false, 'user' => '' ];
        }
        return [ 'success' => true, 'user' => $user ];
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $obj = Users::find($id)->update($data);

        if (!$obj) {
            return [ 'success' => false, 'user' => '' ];
        }
        
        $return = Users::find($id);     
        return [ 'success' => true, 'user' => $return ];
    }

    public function destroy($id)
    {
        $user = Users::find($id);
        if (!$user) {
            return [ 'success' => false ];
        }

        $user->delete();
        return [ 'success' => true ];        
    }
}
