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
    	$players = Player::orderBy('wins', 'desc')->orderBy('losses', 'asc')->get();
    	
    	//dd(request(['wins']),request(['losses']),$players,$winIds);
    	

    	foreach ($players as $player) {
    		$playerIds[] = $player->id;
    	}

    	$idTest = "1,2";
    	$contains = str_contains($idTest, ',');

    	$playersArray = $players->toArray();
    	$playerId = $playersArray[0]["id"];
    	$playerMet = $playersArray[0]["met"];
    	$player2Id = $playersArray[3]["id"];
    	if ($playerMet == $player2Id) {
    		$say = "Met = True";
    	}
    	else{
    		$say = "Met = False";
    	}

    	foreach (array_slice($playersArray,1) as $pa) {
    		$test[] = $pa;
    		if (!$playerMet == $player2Id) {
    			$say = "Met = True";
    		}
    		else{
    			
    		}
    	}

  		// $result = Player::orderBy('wins', 'desc')->orderBy('losses', 'asc')->get();
		// $result = $result->toArray();
		// $resultName = $result[0]["name"];

    	dd($test, $say, $playerId, $playerMet, $playersArray, $players, $playerIds, $contains);
    	
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
