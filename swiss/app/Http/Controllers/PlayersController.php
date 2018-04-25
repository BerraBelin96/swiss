<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;
use App\Tournaments;
use App\GameHistory;

class PlayersController extends Controller
{
    public function index($tournament)
    {
        $players = Player::where('tournament', $tournament)->get();
        
    	return view('newTournament', compact('players', 'tournament'));
    }

    public function add()
    {
    	//Lägger till namn i databasen

    	$players = new Player;
    	$this->validate(request(), ['name' => 'required']);

        Player::create(request(['name','tournament']));

    	return back();
    }

    public function delete($id)
    {
        //Tar bort namn från databasen

        $players = new Player;
        Player::where('id', $id)->delete();
        return back();
    }

    public function update()
    {
        $tournament = request(['tournament']);
        $tournament = $tournament["tournament"];
        $winIds = request(['wins']);
        $winIds = $winIds['wins'];
        
        foreach ($winIds as $winId) {

            $players = Player::get()->where('id', $winId);
            
            foreach ($players as $player) {
                $playerWin = $player->wins;
            }
            $winNum = $playerWin + 1;
            Player::where('id', $winId)->update(['wins' => $winNum]);


            $currentGame = CurrentGame::where('tournament', $tournament)->get();
            $currentGameArray = $currentGame->toArray();
            foreach ($currentGameArray as $key => $value) {
                if ($value["playerOne"] == $winId) {
                    GameHistory::create(['playerOne' => $value["playerOne"],
                                         'playerTwo' => $value["playerTwo"],
                                         'winner' => $value["playerOne"],
                                         'tournament' => $tournament]);
                }
                if ($value["playerTwo"] == $winId) {
                    GameHistory::create(['playerOne' => $value["playerOne"],
                                         'playerTwo' => $value["playerTwo"],
                                         'winner' => $value["playerTwo"],
                                         'tournament' => $tournament]);
                }
            }
        }

        $losseIds = request(['losses']);
        $losseIds = $losseIds['losses'];

        foreach ($losseIds as $losseId) {
            
            $players = Player::get()->where('id', $losseId);

            foreach ($players as $player) {
                $playerlosse = $player->losses;
            }
            $losseNum = $playerlosse + 1;
            Player::where('id', $losseId)->update(['losses' => $losseNum]);
        }

        return redirect()->route('nextGame', ['tournament' => $tournament]);

    }
}
