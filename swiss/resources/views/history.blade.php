@extends('layouts.master')

@section('content')
<div class="container-fluid text-center">
<div class="row justify-content-center">
    <div class="col-md-8">
        @foreach ($tournamentName as $Name)
            <h1 class="">Score from '{{ $Name->name }}'</h1>
        @endforeach
        <hr>
    </div>
</div>
</div>
<div class="container-fluid">
<div class="row justify-content-center col-md-8 mx-auto">
    <table class="table historyTable" id="historyTable">
  <thead>
    <tr>
      <th scope="col">Player One</th>
      <th scope="col">Player Two</th>
      <th scope="col">Winner</th>
      <th scope="col">Round</th>
      <th scope="col">Date/time</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($gameHistory as $game)
    <tr>
      <td>{{ $game->p1_name }}</td>
      <td>{{ $game->p2_name }}</td>
      <td>{{ $game->p_win }}</td>
      <td>{{ $game->round }}</td>
      <td>{{ $game->created_at->toDateTimeString() }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
 @endsection
