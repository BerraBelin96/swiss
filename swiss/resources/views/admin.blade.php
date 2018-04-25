@extends('layouts.master')

@section('content')
<div class="container-fluid text-center">
    <div class="row justify-content-center" id="tournament-btn">
        <div class="col-md-8">
            <form method="POST" action="/createTournament">
             {{ csrf_field() }}
             <div class="input-group col-md-10 mx-auto">
                 <input type="text" class="form-control" id="name" name="name"
                 placeholder="Create a new tournament"> <span class="input-group-btn">
                     <button type="submit" class="btn btn-secondary">Create</button>
                 </span>
             </div>
             @include('layouts.errors')
         </form>
         <br>
         <button type="button" class="btn btn-secondary"><a href="#">Tournament history</a></button>
         <hr>
     </div>
 </div>
 </div>
 <div class="container-fluid">
 <div class="row justify-content-center col-md-8 mx-auto">
         @foreach ($tournament as $tournaments)
         @guest
         <a class="col-md-12" href="{{ URL::to('/current/'.$tournaments->id) }}">
        @else
        <a class="col-md-12" href="{{ URL::to('admin/current/'.$tournaments->id) }}">
            @endguest
         <div id="tournamentName">{{ $tournaments->name }} 
            <p class="status">{{ $tournaments->status }}
            </p>
        </div>
        </a>
         @endforeach
         </div>
         </div>
 @endsection
