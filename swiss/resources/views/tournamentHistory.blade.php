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
         @if ($tournaments->status == 'finished')
         @guest
         <a class="col-md-12" href="{{ URL::to('/history/'.$tournaments->id) }}">
        @else
        <a class="col-md-12" href="{{ URL::to('admin/history/'.$tournaments->id) }}">
            @endguest
         <div id="tournamentName">
            <span>{{ $tournaments->name }}</span> 
            <p class="status">{{ $tournaments->status }}
            </p>
        </div>
        </a>
        @endif
         @endforeach
         </div>
         </div>
 @endsection
