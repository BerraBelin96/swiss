<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }
    public function createTournaments()
    {
        $players = Player::latest()->get();
        return view('create', compact('players'));
    }
    public function manageTournaments()
    {
        return view('manage');
    }
    public function currentTournament()
    {
        $players = Player::get();
        $CurrentGame = CurrentGame::join('players as p1', 'current_games.playerOne', '=', 'p1.id')
                                    ->join('players as p2', 'current_games.playerTwo', '=', 'p2.id')
                                    ->select('p1.name as p1_name', 'p2.name as p2_name', 'current_games.playerOne', 'current_games.playerTwo')
                                    ->get();
        // $CurrentGame = CurrentGame::selectRaw("SELECT
        //     cg.playerOne, cg.playerTwo
        //     FROM current_games cg
        //     JOIN players p1 ON p1.name = playerOne
        //     JOIN players p2 ON p2.name = playerTwo")
        //     ->get();
        return view('current', compact('CurrentGame', 'players'));
    }
}
