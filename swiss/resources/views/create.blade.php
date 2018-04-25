@extends('layouts.master')

@section('content')
<div class="container-fluid">
    @foreach ($status as $Status)
    @if ($Status->status == 'new')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="/addname" >

                {{ csrf_field() }}
                <div class="form-group text-center">
                    <label for="players">Add players to your tournament:</label>
                </div>
                <div class="input-group col-md-10 mx-auto">
                    <input type="hidden" name="tournament" value="{{ $tournament }}">
                    <input type="text" class="form-control" id="name" name="name"
                    placeholder="Name"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">Add</button>
                    </span>
                    @if (count($players) >= 4)
                    <button class="btn btn-default"><a href="{{ URL::to('/startTournament/'.$tournament) }}">Save</a></button>
                    @endif
                </div>
                @include('layouts.errors')
            </form>
            <hr>           
        </div>
    </div>
    @else
    @endif
    @endforeach
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (!count($players))
                <p class="text-center">There are currently no players!</p>
            @endif
            {{-- @foreach($players as $player)   
                @endforeach --}}
                @if (count($players))
                <div class="row justify-content-center">
                    <span>Total: {{ $players->count() }}</span>
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
        </div>
    </div>
    @endsection
