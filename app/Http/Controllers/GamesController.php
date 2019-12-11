<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Games;

class GamesController extends Controller
{
    public function index()
    {
        return Games::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['id'] = (DB::table('games')->max('id'))+1;

        $obj = Games::create($data);

        $return = Games::find($data['id']);        
        return $return;
    }

    public function show($id)
    {
        return Games::find($id); 
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        Games::find($id)->update($data);

        $return = Games::find($id);     
        return $return;
    }

    public function destroy($id)
    {
        Games::find($id)->delete();
        return 'success';
    }
}
