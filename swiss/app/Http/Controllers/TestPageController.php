<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\CurrentGame;
use App\Tournaments;

class TestPageController extends Controller
{
    public function formTest($tournament)
    {
        $players = Player::where('tournament', $tournament)->get();
        
        return view('testPage.testpage', compact('players', 'tournament'));
    }
}
