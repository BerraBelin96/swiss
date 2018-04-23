@extends('testPage.base')
@section('content')

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




@endsection