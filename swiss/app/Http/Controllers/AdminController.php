<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }
    public function createTournaments()
    {
        $players = Player::latest()->get();
        return view('create', compact('players'));
    }
    public function manageTournaments()
    {
        return view('manage');
    }
    public function currentTournament()
    {
        return view('current');
    }
}
