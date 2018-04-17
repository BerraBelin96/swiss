<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tournaments;

class TournamentController extends Controller
{
    public function index()
    {
    	return view('newTournament');
    }

    public function create()
    {
    	//Lägger till en ny tournament i databasen

    	$Tournaments = new Tournaments;
    	$this->validate(request(), ['name' => 'required']);

    	Tournaments::create(request(['name']));
        
        $Tournaments = Tournaments::get();
        dd($Tournaments);
        
    	return back();

    	//return view('newTournament');
    }

}
