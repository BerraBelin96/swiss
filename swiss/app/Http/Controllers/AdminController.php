<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;
use App\Tournaments;
use App\GameHistory;
use App\Admin;

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
        $tournament = Tournaments::get();
        return view('index', compact('tournament'));
    }
    public function createTournaments($tournament)
    {
        $players = Player::where('tournament', $tournament)->latest()->get();
        $recentPlayers = Player::orderBy('updated_at', 'desc')->take(10)->where('tournament', NULL)->get();
        $status = Tournaments::where('id', $tournament)->get();
        $tournamentName = Tournaments::where('id', $tournament)->get();
        return view('create', compact('players', 'tournament', 'status', 'recentPlayers', 'tournamentName'));
    }
    public function manageTournaments()
    {
        return view('manage');
    }
    public function currentTournament($tournament)
    {
        
        $players = Player::where('tournament', $tournament)->get();
        // $CurrentGame = CurrentGame::where('tournament', $tournament)->get();
        // $playersArray = $players->toArray();

        $tournamentName = Tournaments::where('id', $tournament)->get();
        
        $CurrentGame = CurrentGame::join('players as p1', 'current_games.playerOne', '=', 'p1.id')
                                    ->join('players as p2', 'current_games.playerTwo', '=', 'p2.id')
                                    ->select('p1.name as p1_name', 'p2.name as p2_name', 'current_games.playerOne', 'current_games.playerTwo', 'p1.wins as p1_wins', 'p1.losses as p1_losses', 'p2.wins as p2_wins', 'p2.losses as p2_losses')
                                    ->where('current_games.tournament', '=', $tournament)
                                    ->get();

            $odd = CurrentGame::join('players as p1', 'current_games.playerOne', '=', 'p1.id')
                                        ->select('p1.name as p1_name', 'current_games.playerOne', 'current_games.playerTwo', 'p1.wins as p1_wins', 'p1.losses as p1_losses')
                                        ->where('playerTwo', '=', 0)
                                        ->where('current_games.tournament', '=', $tournament)
                                        ->get();
        
        // $CurrentGame = CurrentGame::selectRaw("SELECT
        //     cg.playerOne, cg.playerTwo
        //     FROM current_games cg
        //     JOIN players p1 ON p1.name = playerOne
        //     JOIN players p2 ON p2.name = playerTwo")
        //     ->get();
        return view('current', compact('CurrentGame', 'players', 'odd', 'tournament', 'tournamentName'));
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
    public function stop($tournament)
    {
        $players = Player::orderBy('wins', 'desc')->orderBy('losses', 'asc')->where('tournament', $tournament)->get();
        Tournaments::where('id', $tournament)->update(['status' => "stopped"]);
        $tournamentName = Tournaments::where('id', $tournament)->get();
        return view('stopTournament', compact('players', 'tournament', 'tournamentName'));
    }

    public function showAddForm()
    {
        return view('auth.admin-register');
    }
    public function addAdmin()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'password'
        ]);
    }
}
