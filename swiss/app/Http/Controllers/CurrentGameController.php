<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;

class CurrentGameController extends Controller
{
    public function index($tournament)
    {
    	$players = Player::where('tournament', $tournament)->get();
        // !!! Skriv om funktionen så detta funkar !!!
        // $playersArray = $players->toArray();
    	
    	foreach ($players as $player) {
    		$playerIds[] = $player->id;
    	}
    	shuffle($playerIds);
    	
    	$piCount = count($playerIds);
    	
    	$playerIds1 = array_slice($playerIds, $piCount/2);
    	$playerIds2 = array_slice($playerIds, 0, $piCount/2);

    	$pi1Count = count($playerIds1);
    	for ($row = 0; $row < $pi1Count; $row++) {
    		if (isset($playerIds1[$row])) {
                $pi1 = $playerIds1[$row];
            }
            else {
                $pi1 = 0;
                Player::where('id', $playerIds2[$row])->update(['wait' => 1]);
            }

            if (isset($playerIds2[$row])) {
                $pi2 = $playerIds2[$row];
            }
            else {
                $pi2 = 0;
                Player::where('id', $playerIds1[$row])->update(['wait' => 1]);
            }
    		
    		CurrentGame::create(['playerOne' => $pi1,'playerTwo' => $pi2,'tournament' => $tournament]);

    		Player::where('id', $pi1)->update(['met' => $pi2]);
    		Player::where('id', $pi2)->update(['met' => $pi1]);
    	}

        // !!! Skriv om funktionen så detta funkar !!!
        //$piCount = count($playerIds);
        // $playersArrayCount = count($playersArray);
        // if ($playersArrayCount & 1 ) {
        //     foreach ($playersArrayCount as $key => $value) {
        //         if ($value["id"] == $pi1) {
        //             Player::where('id', $value["id"])->update(['wait' => $value["wait"]+1]);
        //         }
        //     }
        // }
    	
    	// return redirect()->route('admin.current');
        return redirect()->route('admin.current', ['tournament' => $tournament]);
    }

    public function nextGame($tournament)
    {
        // dd(request()->all());

        $players = Player::orderBy('wins', 'desc')->orderBy('losses', 'asc')->where('tournament', $tournament)->get();
        
    	foreach ($players as $player) {
    		$playerIds[] = $player->id;
    	}

    	$playersArray = $players->toArray();
    	$playerId = $playersArray[0]["id"];
    	$playerMet = $playersArray[0]["met"];
    	$player2Id = $playersArray[3]["id"];
    	
        $playersArrayStartCount = count($playersArray);
        foreach ($playersArray as $key => $value) {
            
            $valueMetContains = str_contains($value["met"], '|');
            if ($valueMetContains) {
                $valueMet = explode("|", $value["met"]);
            }
            else {
                $valueMet[] = $value["met"];
            }
            if ($playersArrayStartCount & 1 ) {
                if (count($valueMet) >= $playersArrayStartCount) {
                    $playersArray[$key]["met"] = end($valueMet);
                }
            }
            else {
                if (count($valueMet) >= $playersArrayStartCount-1) {
                    $playersArray[$key]["met"] = end($valueMet);
                }
            }
        }

        //Här bestäms vem som ska vänta den här rundan om det är ett udda antal spelare.
        $playersArrayCount = count($playersArray);
        if ($playersArrayCount & 1 ) {
            
            $i = 0;
            while (!isset($waitPlayer)) {
                
                foreach ($playersArray as $player) {
                    if ($player["wait"] == $i) {
                        $playersNotWaited[] = $player;
                    }

                }
                if (isset($playersNotWaited)) {
                    $waitPlayer = end($playersNotWaited);
                    foreach ($playersArray as $key => $value) {
                        if ($value["id"] == $waitPlayer["id"]) {
                            unset($playersArray[$key]);
                        }
                    }
                }
                else {
                    $i++;
                }
            }
        }

    	while (count($playersArray) > 0) {

			$keys = array_keys($playersArray);
			$player1Key = $keys[0];
			$i = 1;
			$player2Key = $keys[$i];
            
            $player1MetContains = str_contains($playersArray[$player1Key]["met"], '|');
            if ($player1MetContains) {
                $player1Met = explode("|", $playersArray[$player1Key]["met"]);
            }
            else {
                $player1Met[] = $playersArray[$player1Key]["met"];
            }
            
	    	if (in_array($playersArray[$player2Key]["id"], $player1Met)) {
	    		while (in_array($playersArray[$player2Key]["id"], $player1Met)) {
                    if (!isset($keys[$i])) {
                        break 1;
                    }
                    $player2Key = $keys[$i];
                    $i++;
	    		}
	    		$player1PlayersArray[] = $playersArray[$player1Key];
	    		$player2PlayersArray[] = $playersArray[$player2Key];
	    		unset($playersArray[$player1Key]);
	    		unset($playersArray[$player2Key]);
	    	}
	    	else{
	    		$player1PlayersArray[] = $playersArray[$player1Key];
	    		$player2PlayersArray[] = $playersArray[$player2Key];
	    		unset($playersArray[$player1Key]);
	    		unset($playersArray[$player2Key]);
	    	}
    	}

        //dd($playersArrayStartCount, $waitPlayer, $players, $player1Met, $playersArray, $player1Key, $player2Key, $playerIds, $player1PlayersArray, $player2PlayersArray);

        foreach ($player1PlayersArray as $key => $value) {
            Player::where('id', $player1PlayersArray[$key]["id"])->update(['met' => $player1PlayersArray[$key]["met"] . "|" . $player2PlayersArray[$key]["id"]]);
            Player::where('id', $player2PlayersArray[$key]["id"])->update(['met' => $player2PlayersArray[$key]["met"] . "|" . $player1PlayersArray[$key]["id"]]);
        }

        if (isset($waitPlayer)) {
            Player::where('id', $waitPlayer["id"])->update(['met' => $waitPlayer["met"] . "|" . "0"]);
            Player::where('id', $waitPlayer["id"])->update(['wait' => $waitPlayer["wait"]+1]);
        }


        CurrentGame::where('tournament', $tournament)->delete();
        
        foreach ($player1PlayersArray as $key => $value) {
            CurrentGame::create(['playerOne' => $player1PlayersArray[$key]["id"],'playerTwo' => $player2PlayersArray[$key]["id"],'tournament' => $tournament]);
        }

        if (isset($waitPlayer)) {
            CurrentGame::create(['playerOne' => $waitPlayer["id"],'playerTwo' => "0",'tournament' => $tournament]);
        }

    	// dd($players, $player1Met, $playersArray, $player1Key, $player2Key, $playerIds, $player1PlayersArray, $player2PlayersArray);
    	
    	return redirect()->route('admin.current', ['tournament' => $tournament]);

        // return redirect()->route('admin.current', ['tournament' => $tournament]);
    }
}
