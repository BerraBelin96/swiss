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
        
        // dd($TournamentsArray, $TournamentsName[0], $TournamentsName[0]["id"], $TournamentsFlip);
    	// return back();
    	// return redirect()->route('admin.current');
    	return redirect()->route('formTest', ['tournament' => $TournamentsName[0]["id"]]);

    	//return view('newTournament');
    }

}
