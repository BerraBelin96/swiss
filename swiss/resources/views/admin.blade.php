@extends('layouts.master')

@section('content')
<div class="container-fluid text-center">
    <div class="row justify-content-center" id="tournament-btn">
        <div class="col-md-8">
            <button type="button" class="btn btn-secondary"><a href="#">Tournament history</a></button>
            <br><br><p>or</p>
            <form method="POST" action="/createTournament">
             {{ csrf_field() }}
             <div class="input-group col-md-10 mx-auto">
                 <input type="text" class="form-control" id="name" name="name"
                 placeholder="Create a new tournament"> <span class="input-group-btn">
                     <button type="submit" class="btn btn-secondary">Create</button>
                     <button type="button" class="btn btn-secondary"><a href="#">Tournament history</a></button>
                 </span>
             </div>
             @include('layouts.errors')
         </form>
         <br><p>or</p><br>
         <button type="button" class="btn btn-secondary"><a href="#">Tournament history</a></button>
         <hr>
     </div>
     <div class="col-md-8">
        <div class="row">
         @foreach ($tournament as $tournaments)
         <div class="col-md-6">{{ $tournaments->name }}</div>
         @endforeach
         </div>
     </div>
 </div>
     
</div>
@endsection
