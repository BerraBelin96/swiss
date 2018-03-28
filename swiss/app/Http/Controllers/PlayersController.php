<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlayersController extends Controller
{
    public function index()
    {
    	$players = Player::get();

    	return view('newTournament', compact('players'));
    }

    public function add()
    {
    	//Lägger till namn i databasen

    	$players = new Player;
    	$this->validate(request(), ['name' => 'required']);

    	Player::create(request(['name']));

    	return back();
    }

    public function delete($id)
    {
        //Tar bort namn från databasen

        $players = new Player;
        Player::where('id', $id)->delete();
        return back();
    }

    public function formTest()
    {
        $players = Player::get();
        
        return view('testpage', compact('players'));
    }

    public function update()
    {
        $winIds = request(['wins']);
        $winIds = $winIds['wins'];
        
        foreach ($winIds as $winId) {

            $players = Player::get()->where('id', $winId);

            foreach ($players as $player) {
                $playerWin = $player->wins;
            }
            $winNum = $playerWin + 1;
            Player::where('id', $winId)->update(['wins' => $winNum]);
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

        dd(request(['wins']),request(['losses']),$players,$winIds);
        
        return back();
    }
}
