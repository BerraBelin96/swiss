<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;
use App\Tournaments;

class TestPageController extends Controller
{
    public function formTest($tournament)
    {
        $players = Player::where('tournament', $tournament)->get();
        
        return view('testPage.testpage', compact('players', 'tournament'));
    }

    public function printGame($tournament)
    {
        $players = Player::where('tournament', $tournament)->get();
        // $CurrentGame = CurrentGame::where('tournament', $tournament)->get();
        // $playersArray = $players->toArray();
        
        $CurrentGame = CurrentGame::join('players as p1', 'current_games.playerOne', '=', 'p1.id')
                                    ->join('players as p2', 'current_games.playerTwo', '=', 'p2.id')
                                    ->select('p1.name as p1_name', 'p2.name as p2_name', 'current_games.playerOne', 'current_games.playerTwo')
                                    ->where('current_games.tournament', '=', $tournament)
                                    ->get();

            $odd = CurrentGame::join('players as p1', 'current_games.playerOne', '=', 'p1.id')
                                        ->select('p1.name as p1_name', 'current_games.playerOne', 'current_games.playerTwo')
                                        ->where('playerTwo', '=', 0)
                                        ->where('current_games.tournament', '=', $tournament)
                                        ->get();
        
        return view('testPage.printGame', compact('CurrentGame', 'players', 'odd', 'tournament'));
        // return view('testPage.printGame', compact('players', 'tournament'));
    }
}
