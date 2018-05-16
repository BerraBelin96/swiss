<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;
use App\Tournaments;
use App\GameHistory;

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
    public function index()
    {
        $tournament = Tournaments::get();
        return view('index', compact('tournament'));
    }
    public function history()
    {
        $tournament = Tournaments::get();
        return view('tournamentHistory', compact('tournament'));
    }
    public function historyTournament($tournament)
    {
        $tournamentName = Tournaments::where('id', $tournament)->get();
        $gameHistory = GameHistory::join('players as p1', 'game_histories.playerOne', '=', 'p1.id')
                                    ->join('players as p2', 'game_histories.playerTwo', '=', 'p2.id')
                                    ->join('players as p3', 'game_histories.winner', '=', 'p3.id')
                                    ->select('p1.name as p1_name', 'p2.name as p2_name', 'p3.name as p_win', 'game_histories.round', 'game_histories.created_at')
                                    ->orderBy('game_histories.round', 'asc')
                                    ->where('game_histories.tournament', '=', $tournament)
                                    ->get();
        return view('history', compact('gameHistory', 'tournamentName'));
    }
    public function current($tournament)
    {
        $players = Player::where('tournament', $tournament)->get();
        $tournamentName = Tournaments::where('id', $tournament)->get();
        $CurrentGame = CurrentGame::join('players as p1', 'current_games.playerOne', '=', 'p1.id')
                                    ->join('players as p2', 'current_games.playerTwo', '=', 'p2.id')
                                    ->select('p1.name as p1_name', 'p2.name as p2_name', 'current_games.playerOne', 'current_games.playerTwo', 'p1.wins as p1_wins', 'p1.losses as p1_losses', 'p2.wins as p2_wins', 'p2.losses as p2_losses')
                                    ->where('current_games.tournament', '=', $tournament)
                                    ->get();

        $odd = CurrentGame::join('players as p1', 'current_games.playerOne', '=', 'p1.id')
                            ->select('p1.name as p1_name', 'current_games.playerOne', 'current_games.playerTwo')
                            ->where('playerTwo', '=', 0)
                            ->where('current_games.tournament', '=', $tournament)
                            ->get();
        
        return view('current', compact('CurrentGame', 'players', 'odd', 'tournamentName'));
    }
}
