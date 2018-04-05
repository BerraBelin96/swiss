<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;

class DevHelperController extends Controller
{
    public function index()
    {
    	echo "<a>Dev Helper</a> <br>";
    	echo "
    		<a href='/dev/addPlayers/4'>Add 4 Players</a> <br>
    		<a href='/dev/addPlayers/5'>Add 5 Players</a> <br>
    		<a href='/dev/empty/player'>Empty the Players table</a> <br>
    		<a href='/dev/empty/CurrentGame'>Empty the CurrentGame table</a> <br>
    	";
    }

    public function empty($table)
    {
    	switch ($table) {
    		case 'Player':
    		case 'player':
    		case 'Players':
    		case 'players':
    			Player::truncate();
    			$say = "The Player table is now empty!";
    		break;

    		case 'CurrentGame':
    		case 'currentgame':
    		case 'CG':
    		case 'cg':
    			CurrentGame::truncate();
    			$say = "The CurrentGame table is now empty!";
    		break;
    		
    		default:
    			$say = "No table got emptied! No table specified.";
    		break;
    	}
    	//DB::table('users')->truncate();
    	//Player::truncate();
    	//$say = "The Player table is now empty!";
    	dd($say);
    }

	public function addPlayers($amount)
    {
    	switch ($amount) {
    		case '4':
    			Player::create(['name' => 'Jonas Belin',]);
    			Player::create(['name' => 'Jon Doe',]);
    			Player::create(['name' => 'Musse Pig',]);
    			Player::create(['name' => 'Mimmi Pig',]);

    			$say = "4 names added!";
    		break;

    		case '5':
    			Player::create(['name' => 'Jonas Belin',]);
    			Player::create(['name' => 'Jon Doe',]);
    			Player::create(['name' => 'Musse Pig',]);
    			Player::create(['name' => 'Mimmi Pig',]);
    			Player::create(['name' => 'Kalle Anka',]);

    			$say = "5 names added!";
    		break;
    		
    		default:
    			$say = "No names added! Amount not specified.";
    		break;
    	}
    	//$this->validate(request(), ['name' => 'required']);
    	//Player::create(['name' => 'Jonas Belin',]);

    	//return back();
    	//$say = "Names added!";
    	dd($say);
    }    
}
