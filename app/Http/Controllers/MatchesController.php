<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Match;
use App\User;

class MatchesController extends Controller
{
    
    public function index()
    {
        return Match::findAll(); 
    }

    public function store(Request $request)
    {
        $data = $request->all();

        //Validação de maneira manual
        // $validacao = \Validator::make($data,[
        //     "name" => "required",
        //     "nPlayers" => "required",
        //     "nTeams" => "required",
        //     "time" => "required"
        // ]);

        // if($validacao->fails()) {
        //     return redirect()->back()->withErrors($validacao)->withInput();
        // }
        
        Match::create($data);

        return redirect()->back();
    }

    public function show($id)
    {
        return Match::find($id); 
    }

    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        //Validação de maneira manual
        // $validacao = \Validator::make($data,[
        //     "name" => "required",
        //     "nPlayers" => "required",
        //     "nTeams" => "required",
        //     "time" => "required"
        // ]);

        // if($validacao->fails()) {
        //     return redirect()->back()->withErrors($validacao)->withInput();
        // }
        
        Match::find($id)->update($data);
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
        Match::find($id)->delete();
        return redirect()->back();
    }
}
