<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;

class CurrentGameController extends Controller
{
    public function index()
    {
    	$players = Player::get();
    	
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
    		}

    		if (isset($playerIds2[$row])) {
    			$pi2 = $playerIds2[$row];
    		}
    		else {
    			$pi2 = 0;
    		}
    		
    		CurrentGame::create(['playerOne' => $pi1,'playerTwo' => $pi2]);

    		Player::where('id', $pi1)->update(['met' => $pi2]);
    		Player::where('id', $pi2)->update(['met' => $pi1]);
    	}
    	
    	return redirect()->route('admin.current');
    }

    public function nextGame()
    {
        // dd(request()->all());

        $players = Player::orderBy('wins', 'desc')->orderBy('losses', 'asc')->get();
        
    	foreach ($players as $player) {
    		$playerIds[] = $player->id;
    	}

    	$playersArray = $players->toArray();
    	$playerId = $playersArray[0]["id"];
    	$playerMet = $playersArray[0]["met"];
    	$player2Id = $playersArray[3]["id"];
    	

        $playersArrayStartCount = count($playersArray);
        

        $playersArrayCount = count($playersArray);
        if ($playersArrayCount & 1 ) {
            print "It's odd";

            $i = 0;
            while (!isset($waitPlayer)) {
                
                foreach ($playersArray as $player) {
                    if (str_contains($player["wait"], $i)) {
                        $playersNotWaited[] = $player;
                    }

                }
                if (isset($playersNotWaited)) {
                    $waitPlayer = end($playersNotWaited);
                }
                else {
                    $i++;
                }
            }

        }

        dd("vv playersNotWaited vv", $playersNotWaited, "vv waitPlayer vv", $waitPlayer, "vv players vv", $players, "vv playersArray vv", $playersArray, "vv playerIds vv", $playerIds);

        /*
        
        dd(request()->all());
        str_contains($playersArray[$player1Key]["met"], '|')
        echo end($people);
        array_count_values($array)
        
        */



    	$playersArrayCount = count($playersArray);
		if ($playersArrayCount & 1 ) {
			print "It's odd";
		  	$playersArray[]["id"] = 0;
		  	end($playersArray);
		  	$last_key = key($playersArray);
		  	$playersArray[$last_key]["met"] = 0;
		}

    	while (count($playersArray) > 0) {

			$keys = array_keys($playersArray);
			$player1Key = $keys[0];
			$i = 1;
			$player2Key = $keys[$i];
            
            //$player1Met = $playersArray[$player1Key]["met"];
            $player1MetContains = str_contains($playersArray[$player1Key]["met"], '|');
            if ($player1MetContains) {
                $player1Met = explode("|", $playersArray[$player1Key]["met"]);
                //$player1Met = $playersArray[$player1Key]["met"];
                //$player1Met[] = $playersArray[$player1Key]["met"];
                //$ifMet = in_array($playersArray[$player2Key]["id"], $player1Met);
            }
            else {
                $player1Met[] = $playersArray[$player1Key]["met"];
                //$ifMet = $playersArray[$player1Key]["met"] == $playersArray[$player2Key]["id"];
            }
            
            // if (in_array($playersArray[$player2Key]["id"], $player1Met)) {
            //     echo "Got Irix" . $playersArray[$player1Key]["id"] . " " . $playersArray[$player2Key]["id"];
            //     $test = in_array($playersArray[$player2Key]["id"], $player1Met);
            // }

	    	if (in_array($playersArray[$player2Key]["id"], $player1Met)) {
	    		while (in_array($playersArray[$player2Key]["id"], $player1Met)) {
                    if (!isset($keys[$i])) {
                        break 1;
                    }
                    $player2Key = $keys[$i];
                    $i++;
	    		}
	    		$player1PlayersArray[] = $playersArray[$player1Key]["id"];
	    		$player2PlayersArray[] = $playersArray[$player2Key]["id"];
	    		unset($playersArray[$player1Key]);
	    		unset($playersArray[$player2Key]);
	    	}
	    	else{
	    		$player1PlayersArray[] = $playersArray[$player1Key]["id"];
	    		$player2PlayersArray[] = $playersArray[$player2Key]["id"];
	    		unset($playersArray[$player1Key]);
	    		unset($playersArray[$player2Key]);
	    	}
    	}


        dd($players, $player1Met, $playersArray, $player1Key, $player2Key, $playerIds, $player1PlayersArray, $player2PlayersArray);

        $playersArray2 = $players->toArray();
        if ($playersArrayCount & 1 ) {
            print "It's odd";
            $playersArray2[]["id"] = 0;
            end($playersArray2);
            $last_key = key($playersArray2);
            $playersArray2[$last_key]["met"] = 0;
        }

        $test = $playersArray2[0]["met"] . "|" . "9";

        foreach ($player1PlayersArray as $key => $value) {
            Player::where('id', $player1PlayersArray[$key])->update(['met' => $playersArray2[$player1PlayersArray[$key]]["met"] . "|" . $player2PlayersArray[$key]]);
            Player::where('id', $player2PlayersArray[$key])->update(['met' => $playersArray2[$player2PlayersArray[$key]]["met"] . "|" . $player1PlayersArray[$key]]);
        }

    	// unset($playerIds[$key]);
    	dd($test, $rand, $players, $player1Met, $playersArray, $player1Key, $player2Key, $playerIds, $player1PlayersArray, $player2PlayersArray);
    	// dd($player1PlayersArray, $player2PlayersArray, $playersArray, $players, $playerIds);

        Player::where('id', $pi1)->update(['met' => $pi2]);
        Player::where('id', $pi2)->update(['met' => $pi1]);

        Player::where('id', $pi1)->update(['met' => $playersArray2[$pi1]["met"] . "|" . $pi2]);
        Player::where('id', $pi2)->update(['met' => $playersArray2[$pi2]["met"] . "|" . $pi1]);

    	// foreach ($playersArray as $key => $value) {
    	// 	$player1Key = $key;
	    // 	if ($playersArray[$player1Key]["met"] == $playersArray[$player2Key]["id"]) {
	    // 		while ($playersArray[$player1Key]["met"] == $playersArray[$player2Key]["id"]) {
	    // 			$player2Key++;
	    // 		}
	    // 		$player1PlayersArray[] = $playersArray[$player1Key]["id"];
	    // 		$player2PlayersArray[] = $playersArray[$player2Key]["id"];
	    // 	}
	    // 	else{
	    // 		$player1PlayersArray[] = $playersArray[$player1Key]["id"];
	    // 		$player2PlayersArray[] = $playersArray[$player1Key+1]["id"];
	    // 	}
    	// }





    	// dd($player1PlayersArray, $player2PlayersArray, $say, $playerId, $playerMet, $playersArray, $players, $playerIds, $contains);
    	
    	$piCount = count($playerIds);
    	$piCountHalf = ceil($piCount/2);
    	
    	$playerIds1 = array_slice($playerIds, 0, $piCountHalf);
    	$playerIds2 = array_slice($playerIds, $piCountHalf);

    	$piTest = ceil($piCount/2);

    	dd($playerIds1, $playerIds2, $piCount/2, $piTest, $piCountHalf);

    	$pi1Count = count($playerIds1);
    	for ($row = 0; $row < $pi1Count; $row++) {
    		if (isset($playerIds1[$row])) {
    			$pi1 = $playerIds1[$row];
    		}
    		else {
    			$pi1 = 0;
    		}

    		if (isset($playerIds2[$row])) {
    			$pi2 = $playerIds2[$row];
    		}
    		else {
    			$pi2 = 0;
    		}
    		
    		CurrentGame::create(['playerOne' => $pi1,'playerTwo' => $pi2]);

    		Player::where('id', $pi1)->update(['met' => $pi2]);
    		Player::where('id', $pi2)->update(['met' => $pi1]);
    	}
    	
    	return redirect()->route('admin.current');
    }
}
