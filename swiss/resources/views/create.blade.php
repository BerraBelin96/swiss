@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center text-center">
        <div class="col-md-8">
            <form method="POST" action="/addname" >

                {{ csrf_field() }}
                <div class="form-group">
                    <label for="players">Add players to your tournament:</label>
                </div>
                <div class="input-group col-md-10 mx-auto">
                    <input type="text" class="form-control" id="name" name="name"
                    placeholder="Name"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">Add</button>
                    </span>
                </div>
                @include('layouts.errors')
            </form>
            <hr>           
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (!count($players))
                <p class="text-center">There are currently no players!</p>
            @endif
            {{-- @foreach($players as $player)   
                @endforeach --}}  
                <table class="col-md-10 mx-auto">
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
