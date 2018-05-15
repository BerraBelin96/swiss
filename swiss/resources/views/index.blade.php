@extends('layouts.master')

@section('content')
<div class="container-fluid text-center">
    @guest
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Tournaments</h1>
            <hr>
        </div>
    </div>
    @else
    <div class="row justify-content-center" id="tournament-btn">
        <div class="col-md-8">
            <form method="POST" action="/createTournament">
             {{ csrf_field() }}
             <div class="input-group col-md-10 mx-auto">
                 <input type="text" class="form-control" id="name" name="name"
                 placeholder="Create a tournament" autofocus> <span class="input-group-btn">
                     <button type="submit" class="btn btn-secondary">Create</button>
                 </span>
             </div>
             @include('layouts.errors')
         </form>
         <br>
         <button type="button" class="btn btn-secondary"><a href="{{ route('admin.history') }}">Tournament history</a></button>
         <hr>
     </div>
 </div>
 @endguest
 </div>
 <div class="container-fluid">
 <div class="row justify-content-center col-md-8 mx-auto">
         @foreach ($tournament as $tournaments)
         @if ($tournaments->status != 'finished')
         @guest
         <a class="col-md-12" href="{{ URL::to('/current/'.$tournaments->id) }}">
        @else
        <a class="col-md-12" href="{{ URL::to('admin/current/'.$tournaments->id) }}">
            @if ( $tournaments->status == 'new' )
                <a class="col-md-12" href="{{ URL::to('admin/create/'.$tournaments->id) }}">
            @endif
            @if ( $tournaments->status == 'stopped' )
                <a class="col-md-12" href="{{ URL::to('admin/stopTournament/'.$tournaments->id) }}">
            @endif
        @endguest
         <div id="tournamentName">
            <span>{{ $tournaments->name }}</span> 
            <span class="status">{{ $tournaments->status }}
            </span>
        </div>
        </a>
        @endif
         @endforeach
         </div>
         </div>
 @endsection
