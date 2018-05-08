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
    	// Lägger till namn i databasen

    	$players = new Player;
    	$this->validate(request(), ['name' => 'required']);

        Player::create(request(['name','tournament'])); 
        $tournament = request(['tournament']);
        $tournament = $tournament["tournament"];

    	return redirect()->route('admin.create', ['tournament' => $tournament]);
    }

    public function delete($id)
    {
        // Tar bort en spelare från en turnering

        Player::where('id', $id)->update(['wins' => '0']);
        Player::where('id', $id)->update(['losses' => '0']);
        Player::where('id', $id)->update(['wait' => '0']);
        Player::where('id', $id)->update(['met' => NULL]);
        Player::where('id', $id)->update(['tournament' => NULL]);
        return back();
    }

    public function update()
    {
        // Ökar spelarnas "wins" och "losses" värden. 

        $tournament = request(['tournament']);
        $tournament = $tournament["tournament"];

        $action = request(['action']);
        $action = $action["action"];

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
            $tournaments = Tournaments::where('id', $tournament)->get();
            $tournamentsArray = $tournaments->toArray();
            $tournamentId = $tournamentsArray[0]['current_round'];

            foreach ($currentGameArray as $key => $value) {
                if ($value["playerOne"] == $winId) {
                    GameHistory::create(['playerOne' => $value["playerOne"],
                                         'playerTwo' => $value["playerTwo"],
                                         'winner' => $value["playerOne"],
                                         'round' => $tournamentId,
                                         'tournament' => $tournament]);
                }
                if ($value["playerTwo"] == $winId) {
                    GameHistory::create(['playerOne' => $value["playerOne"],
                                         'playerTwo' => $value["playerTwo"],
                                         'winner' => $value["playerTwo"],
                                         'round' => $tournamentId,
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

        // Här bestämms om turneringen ska avslutas eller starta en ny runda, beroende på vilken knapp användaren tröck på i formuläret. 
        
        switch ($action) {
            case 'Next':
                return redirect()->route('nextGame', ['tournament' => $tournament]);
                break;

            case 'End':
                return redirect()->route('endTournament', ['tournament' => $tournament]);
                break;
            
            default:
                return redirect()->route('nextGame', ['tournament' => $tournament]);
                break;
        }

    }

    public function search()
    {
        // Söker i databasen efter spelare som har de namn, eller ett liknande namn, som användaren sökte efter. 

        $tournament = request(['tournament']);
        $tournament = $tournament["tournament"];
        $name = request(['name']);
        $name = $name["name"];
        $searchPlayers = Player::Where('name', 'like', '%' . $name . '%')->get();

        $players = Player::where('tournament', $tournament)->get();
        $status = Tournaments::where('id', $tournament)->get();
        
        return redirect()->route('admin.create', ['tournament' => $tournament])
                         ->with('searchPlayers', $searchPlayers);
    }

    public function setTournament()
    {
        // Ändrar en spelares tournament värde

        $tournament = request(['tournament']);
        $tournament = $tournament["tournament"];
        $id = request(['playerId']);
        $id = $id["playerId"];

        Player::where('id', $id)->update(['tournament' => $tournament]);

        $players = Player::where('tournament', $tournament)->get();
        $status = Tournaments::where('id', $tournament)->get();
        // return view('create', compact('players', 'tournament', 'status'));
        return redirect()->route('admin.create', ['tournament' => $tournament]);
    }
}
