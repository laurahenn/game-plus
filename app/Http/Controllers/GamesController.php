<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Games;

class GamesController extends Controller
{
    public function index()
    {
        $games = Games::all();
        if (!$games) {
            return [ 'success' => false, 'games' => '' ];
        }

        return [ 'success' => false, 'games' => $games ];
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['id'] = (DB::table('games')->max('id'))+1;

        $obj = Games::create($data);
        if (!$obj) {
            return [ 'success' => false, 'game' => '' ];
        }

        $return = Games::find($data['id']);        
        return [ 'success' => true, 'game' => $return ];
    }

    public function show($id)
    {
        $game = Games::find($id); 
        if (!$game) {
            return [ 'success' => false, 'game' => '' ];
        }
        return [ 'success' => true, 'game' => $game ];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $obj = Games::find($id)->update($data);

        if (!$obj) {
            return [ 'success' => false, 'game' => '' ];
        }
        
        $return = Games::find($id);     
        return [ 'success' => true, 'game' => $return ];
    }

    public function destroy($id)
    {
        $game = Games::find($id);
        if (!$game) {
            return [ 'success' => false ];
        }

        $game->delete();
        return [ 'success' => true ];     
    }
}
