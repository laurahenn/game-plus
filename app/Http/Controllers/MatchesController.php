<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Matches;
use App\MatchesUsers;
use App\Games;
use App\Users;

class MatchesController extends Controller
{
    public function index()
    {
        $matches = Matches::all();

        if (!$matches) {
            return [
                'success' => false,
                'matches' => ''
            ];
        }

        return [
            'success' => true,
            'matches' => $matches
        ];
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['id'] = (DB::table('matches')->max('id'))+1;

        $obj = Matches::create($data);
        if (!$obj) {
            return [ 'success' => false, 'match' => '' ];
        }

        $match_user = [   
            'id' => ((DB::table('matches_users')->max('id'))+1), 
            'value' => 0,
            'play' => false,
            'pay' => false,
            'userId' => $obj->ownerId, 
            'matchId' => $data['id'] 
        ];

        $obj_match_user = MatchesUsers::create($match_user);

        $return = Matches::find($data['id']);        
        return [ 'success' => true, 'match' => $return ];
    }

    public function show($id)
    {
        $match = Matches::find($id); 
        if (!$match) {
            return [ 'success' => false, 'match' => '' ];
        }

        $user = Users::where('id','=',$match['ownerId'])->first();
        $game = Games::where('id','=',$match['gameId'])->first();
        $available = $this->matches_available(null,$match['id']);

        $match['ownerName'] = $user['name'];
        $match['gameName']  = $game['name'];
        $match['matchesAvailable'] = $available['matches_available'];
        
        return [ 'success' => true, 'match' => $match ];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $obj = Matches::find($id)->update($data);
        if (!$obj) {
            return [ 'success' => false, 'match' => '' ];
        }
        
        $return = Matches::find($id);     
        return [ 'success' => true, 'match' => $return ];
    }

    public function destroy($id)
    {
        $match = Matches::find($id);
        if (!$match) {
            return [ 'success' => false ];
        }

        $match->delete();
        return [ 'success' => true ];     
    }

    // gameId > Procura as partidas pelo código do jogo
    public function matches_games(Request $request, $id)
    {
        $matches = Matches::where('gameId','=',$id)->get();
        if (!$matches) {
            return [ 'success' => false, 'matches' => '' ];
        }

        foreach ($matches as $key => $match) {

            $user = Users::where('id','=',$match['ownerId'])->first();
            $game = Games::where('id','=',$match['gameId'])->first();
            $available = $this->matches_available(null,$match['id']);

            $matches[$key]['ownerName'] = $user['name'];
            $matches[$key]['gameName']  = $game['name'];
            $matches[$key]['matchesAvailable'] = $available['matches_available'];
        }

        return [ 'success' => false, 'matches' => $matches ];
    }

    //  id > Procura vagas disponiveis de uma partida pelo código da partida
    public function matches_available(Request $request = null, $id)
    {
        $nUsers     = MatchesUsers::where('matchId','=',$id)->count();
        $matches    = Matches::where('id','=',$id)->first();
        $game       = Games::where('id','=',$matches['gameId'])->first();

        $nTotal = $game['nPlayers'] * $game['nTeams'];
        $nAvailable = $nTotal - $nUsers;

        return [ 'success' => true, 'matches_available' => $nAvailable ];
    }
    
}
