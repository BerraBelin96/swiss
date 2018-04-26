@extends('layouts.master')

@section('content')
<div class="container-fluid text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Tournament History</h1>
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
         <div id="tournamentName">
            <span>{{ $tournaments->name }}</span> 
            <p class="status">{{ $tournaments->status }}
            </p>
        </div>
        </a>
         @endforeach
         </div>
         </div>
 @endsection
