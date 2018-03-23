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

}
