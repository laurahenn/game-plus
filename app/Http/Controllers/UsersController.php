<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Users;

class UsersController extends Controller
{
    public function index()
    {
        return Users::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['id'] = (DB::table('users')->max('id'))+1;
        $data['password'] = Hash::make($data['password']);

        $obj = Users::create($data);

        $return = Users::find($data['id']);        
        return $return;

    }

    public function show($id)
    {
        return Users::find($id); 
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $data['password'] = Hash::make($data['password']);
        Users::find($id)->update($data);


        $return = Users::find($id);     
        return $return;
    }

    public function destroy($id)
    {
        Users::find($id)->delete();
        return 'success';
    }
}
