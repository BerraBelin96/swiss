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
    	//dd(request()->all());

    	$players = new Player;
    	$this->validate(request(), ['name' => 'required']);

    	Player::create(request(['name']));

    	return back();
    }
}
