@extends('testPage.base')
@section('content')

<p>Tournament id: {{ $tournament }}</p>

<form method="POST" action="/createTournament">
    {{ csrf_field() }}

    <div class="form-group text-center">
        <label for="players">Create new tournament:</label>
    </div>
    <div class="input-group col-md-10 mx-auto">
        <input type="text" class="form-control" id="name" name="name"
        placeholder="Name"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">Add</button>
        </span>
    </div>
    @include('layouts.errors')
</form>

<br>
<hr>
<br>

<form method="POST" action="/endTournament">
    {{ csrf_field() }}
    <input type="hidden" name="tournament" value="{{ $tournament }}">
    <button type="submit" class="btn btn-default">End tournament: {{ $tournament }}</button>
</form>

{{-- <br>

<form method="POST" action="/endTournament">
    {{ csrf_field() }}
    <input type="hidden" name="tournament" value="{{ $tournament }}">
    <button type="submit" class="btn btn-default">Re shuffle tournament: {{ $tournament }}</button>
</form> --}}

<br>
<hr>
<br>

<button class="btn btn-default">
    <a href="{{ URL::to('/reShuffle/'.$tournament) }}">
        Re shuffle tournament: {{ $tournament }}
    </a>
</button>

<br><br><br>

@foreach ($players as $player)
    <tr>
        <td class="col-md-2">{{ $player->name }}</td>
        <td class="col-md-8"></td>
        <td class="col-md-2"><a href="{{ URL::to('/delete/'.$player->id) }}"><span aria-hidden="true">&times;</span></a></td>
    </tr>
    <br>
@endforeach

<br><br><br>

<form method="POST" action="/searchPlayer">
    {{ csrf_field() }}

    <div class="form-group text-center">
        <label for="players">Search Player:</label>
    </div>
    <div class="input-group col-md-10 mx-auto">
        <input type="hidden" name="tournament" value="{{ $tournament }}">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name"> 
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">Search</button>
        </span>
    </div>
    @include('layouts.errors')
</form>

@if (isset($searchPlayers))
    @foreach ($searchPlayers as $key => $sPlayer)
        <p>{{ $sPlayer->name }}</p>
        {{-- <a href="{{ URL::to('/delete/'.$player->id) }}">{{ $sPlayer->name }}</a> --}}
        <form method="POST" action="/playerSetTournament">
            {{ csrf_field() }}
            <input type="hidden" name="tournament" value="{{ $tournament }}">
            <input type="hidden" name="playerId" value="{{ $sPlayer->id }}">
            <button type="submit" class="btn btn-default">Add Player</button>
        </form>
    @endforeach
@endif

@endsection