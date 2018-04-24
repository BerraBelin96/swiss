<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;
use App\Tournaments;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function current()
    {
        $players = Player::get();
        $CurrentGame = CurrentGame::join('players as p1', 'current_games.playerOne', '=', 'p1.id')
                                    ->join('players as p2', 'current_games.playerTwo', '=', 'p2.id')
                                    ->select('p1.name as p1_name', 'p2.name as p2_name', 'current_games.playerOne', 'current_games.playerTwo')
                                    ->get();

            $odd = CurrentGame::join('players as p1', 'current_games.playerOne', '=', 'p1.id')
                                        ->select('p1.name as p1_name', 'current_games.playerOne', 'current_games.playerTwo')
                                        ->where('playerTwo', '=', 0)
                                        ->get();
        
        // $CurrentGame = CurrentGame::selectRaw("SELECT
        //     cg.playerOne, cg.playerTwo
        //     FROM current_games cg
        //     JOIN players p1 ON p1.name = playerOne
        //     JOIN players p2 ON p2.name = playerTwo")
        //     ->get();
        return view('current', compact('CurrentGame', 'players', 'odd'));
    }
}
