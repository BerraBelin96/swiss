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
        $TournamentsArray = $Tournaments->toArray();

        $TournamentsName = Tournaments::orderBy('id', 'desc')->where(request(['name']))->get();
        $TournamentsName= $TournamentsName->toArray();
        
    	return redirect()->route('admin.create', ['tournament' => $TournamentsName[0]["id"]]);
    }

    public function end()
    {
    	$tournament = request(['tournament']);
        $tournament = $tournament["tournament"];

    	Tournaments::where('id', $tournament)->update(['status' => "finished"]);
    	//admin.dashboard
    	return redirect()->route('admin.dashboard');
    }

}
