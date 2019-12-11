<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Matches;

class MatchesController extends Controller
{
    public function index()
    {
        return Matches::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $data['id'] = (DB::table('matches')->max('id'))+1;

        $obj = Matches::create($data);

        $return = Matches::find($data['id']);        
        return $return;
    }

    public function show($id)
    {
        return Matches::find($id); 
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        Matches::find($id)->update($data);

        $return = Matches::find($id);     
        return $return;
    }

    public function destroy($id)
    {
        Matches::find($id)->delete();
        return 'success';
    }
}
