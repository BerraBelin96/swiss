@extends('layouts.master')

@section('content')
<div class="container-fluid text-center">
<div class="row justify-content-center">
    <div class="col-md-8">
        @foreach ($tournamentName as $Name)
            <h1 class="">Leaderboard of '{{ $Name->name }}'</h1>
        @endforeach
        <hr>
    </div>
</div>
</div>
<div class="container-fluid">
<div class="row justify-content-center col-md-8 mx-auto">
    <table class="table leaderboard">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Wins</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($players as $player)
    <tr>
      <td>{{ $player->name }}</td>
      <td>{{ $player->wins }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button class="btn btn-secondary">
  <a href="{{ URL::to('/endTournament/'.$tournament) }}">
      End Tournament
  </a>
</button>
</div>
</div>
 @endsection
