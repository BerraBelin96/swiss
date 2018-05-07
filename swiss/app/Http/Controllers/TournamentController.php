<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tournaments;
use App\Player;

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

    public function end($tournament)
    {
    	// Avsluta en turnering och nollställ spelarna som var med i den turneringen. 
    	
        Player::where('tournament', $tournament)->update(['wins' => '0']);
        Player::where('tournament', $tournament)->update(['losses' => '0']);
        Player::where('tournament', $tournament)->update(['wait' => '0']);
        Player::where('tournament', $tournament)->update(['met' => NULL]);

        Player::where('tournament', $tournament)->update(['tournament' => NULL]);

    	Tournaments::where('id', $tournament)->update(['status' => "finished"]);
    	
    	return redirect()->route('admin.dashboard');
    }

}
