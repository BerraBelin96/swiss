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
    	}
    	
    	return redirect()->route('admin.current');
    }

    public function nextGame()
    {

    }
}
