<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UsersController extends Controller
{
    public function index()
    {
        //
        return Users::all();
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
        
        Users::create($data);

        return redirect()->back();
    }

    public function show($id)
    {
        return Users::find($id); 
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
