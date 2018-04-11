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


<form method="POST" action="/playerUpdate">
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
</form>


{{-- <input class="form-check-input" type="checkbox" id="losses" name="losses[]" value="{{ $player->id }}"> --}}
{{-- <input class="form-check-input" type="checkbox" id="losses" name="losses[]" value="{{ $player->id }}"> --}}