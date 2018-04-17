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


<form method="POST" action="/addname" >

    {{ csrf_field() }}
    <div class="form-group text-center">
        <label for="players">Add players to your tournament:</label>
    </div>
    <div class="input-group col-md-10 mx-auto">
        <input type="hidden" name="tournament" value="{{ $tournament }}">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name"> 
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">Add</button>
        </span>
        @if (count($players) >= 4)
            <button class="btn btn-default"><a href="{{ URL::to('/startTournament') }}">Save</a></button>
        @endif
    </div>
    @include('layouts.errors')
</form>

@foreach ($players as $player)
    <tr>
        <td class="col-md-2">{{ $player->name }}</td>
        <td class="col-md-8"></td>
        <td class="col-md-2"><a href="{{ URL::to('/delete/'.$player->id) }}"><span aria-hidden="true">&times;</span></a></td>
    </tr>
@endforeach









{{-- 
@foreach ($players as $player)
    <div>
        <p> {{ $player->name }} </p>
        <a href="{{ URL::to('/playerUpdateWin/'.$player->id) }}">Win</a>
        <a href="{{ URL::to('/playerUpdateLose/'.$player->id) }}">Lose</a>
        <hr>
    </div>
@endforeach --}}

{{-- @foreach ($players as $player)
<form method="POST" action="/playerUpdate">
    {{ csrf_field() }}
    <div class="form-group text-center">
        
    </div>
    <div class="input-group col-md-10 mx-auto">
        <label class="form-check-label" for="players"> {{ $player->name }} </label>

        <label class="form-check-label" for="won"> Won: </label>
        <input class="form-check-input" type="checkbox" id="won" name="won" value="{{ $player->id }}">

        <label class="form-check-label" for="lost"> Lost: </label>
        <input class="form-check-input" type="checkbox" id="lost" name="lost" value="{{ $player->id }}">
        
        <button type="submit" class="btn btn-default">Add</button>
        <hr>
    </div>
    
    @include('layouts.errors')
</form>
@endforeach --}}



{{-- <form method="POST" action="/playerUpdate">
    {{ csrf_field() }}
    <div class="form-group text-center">
        <label for="title">Select witch players won/losst:</label>
        <hr> 
    </div>
    <div class="input-group col-md-10 mx-auto">

        @foreach ($players as $player)
        <label class="form-check-label" for="players"> {{ $player->name }} </label>

        <label class="form-check-label" for="won"> Won: </label>
        <input class="form-check-input" type="checkbox" id="wins" name="wins[]" value="{{ $player->id }}">

        <label class="form-check-label" for="lost"> Lost: </label>
        <input class="form-check-input" type="checkbox" id="losses" name="losses[]" value="{{ $player->id }}">
        <hr>
        @endforeach

    </div>
    <button type="submit" class="btn btn-default">Add</button>
    @include('layouts.errors')
</form> --}}


{{-- <form method="POST" action="/playerUpdate">
    {{ csrf_field() }}
    @foreach ($players as $player)
    <div class="input-group">
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="">
            {{ $player->name }} {{ $player->id }}
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="wins[]" id="wins" value="{{ $player->id }}">
            <label class="form-check-label" for="won">
                Win
        </label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="losses[]" id="losses" value="{{ $player->id }}">
        <label class="form-check-label" for="lost">
            Lose
        </label>
        </div>

    </div>
        <hr>
    @endforeach
    <button type="submit" class="btn btn-default">Add</button>
</form> --}}

{{-- <input class="form-check-input" type="checkbox" id="losses" name="losses[]" value="{{ $player->id }}"> --}}
{{-- <input class="form-check-input" type="checkbox" id="losses" name="losses[]" value="{{ $player->id }}"> --}}