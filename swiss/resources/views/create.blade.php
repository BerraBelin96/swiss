@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div id="navbarToggleExternalContent" class="col-md-3 right">
        @if (!count($players))
        <p class="text-center">There are currently no players!</p>
        @endif
            {{-- @foreach($players as $player)   
            @endforeach --}}
            @if (count($players))
            <div class="row justify-content-center">
                <p>Total: {{ $players->count() }}</p>
            </div>
            @endif
            <table class="row col-md-10 mx-auto">
                <tbody>
                    @foreach ($players as $player)
                    <tr>
                        <td class="col-md-2">{{ $player->name }}</td>
                        <td class="col-md-8"></td>
                        <td class="col-md-2"><a href="{{ URL::to('/delete/'.$player->id) }}"><span aria-hidden="true">&times;</span></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="center">
            <button class="navbar-toggler" id="button" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon">&equiv;</span>
            </button>
        </div>
        @foreach ($status as $Status)
        @if ($Status->status == 'new')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="/searchPlayer" >

                    {{ csrf_field() }}
                    <div class="form-group text-center">
                        <label for="players">Add players to your tournament:</label>
                    </div>
                    <div class="input-group col-md-10 mx-auto">
                        <input type="hidden" name="tournament" value="{{ $tournament }}">
                        <input type="text" class="form-control" id="name" name="name"
                        placeholder="Search Players" autofocus>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-secondary">Search</button>
                        </span>
                    </div>
                    @include('layouts.errors')
                </form>
                <br>
                @if (session('name'))
                <button class="btn btn-secondary" data-toggle="modal" data-target="#myModal">Add Name</button>
                <div class="modal" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Are you sure you want to add the name: {{ session('name') }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <form method="POST" action="/addname">
                            {{ csrf_field() }}
                            <input type="hidden" name="tournament" value="{{ $tournament }}">
                            <input type="hidden" id="name" name="name" value="{{ session('name') }}">
                            <button type="submit" class="btn btn-secondary">Add</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        @endif
        @if (count($players) >= 4)
        <button class="btn btn-secondary"><a href="{{ URL::to('/startTournament/'.$tournament) }}">Save</a></button>
        @endif
        <hr>           
    </div>
</div>
@else
@endif
@endforeach
<div class="row justify-content-center">
    <div class="col-md-5">
        @if (session('searchPlayers'))
        @foreach (session('searchPlayers') as $key => $sPlayer)
        {{-- <a href="{{ URL::to('/delete/'.$player->id) }}">{{ $sPlayer->name }}</a> --}}
        <form method="POST" action="/playerSetTournament">
            {{ csrf_field() }}
            <input type="hidden" name="tournament" value="{{ $tournament }}">
            <input type="hidden" name="playerId" value="{{ $sPlayer->id }}">
            <button type="submit" class="addName">{{ $sPlayer->name }}</button>
        </form>
        @endforeach
        @endif
    </div>
    
</div>
@endsection
