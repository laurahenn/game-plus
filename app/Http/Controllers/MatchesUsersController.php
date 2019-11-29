<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\MatchUser;
use App\User;

class MatchesUsersController extends Controller
{
    
    public function index()
    {
        return MatchUser::findAll(); 
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
        
        MatchUser::create($data);

        return redirect()->back();
    }

    public function show($id)
    {
        return MatchUser::find($id); 
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
        
        MatchUser::find($id)->update($data);
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
        MatchUser::find($id)->delete();
        return redirect()->back();
    }
}
