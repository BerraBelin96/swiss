<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;

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
}
