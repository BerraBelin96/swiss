@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <h1>Welcome!</h1>

                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as <strong>ADMIN</strong>
                
        </div>
    </div>
    <div class="row justify-content-center" id="tournament-btn">
        <div class="col-md-8">
            <button type="button" class="btn btn-secondary"><a href="#">Manage tournaments</a></button>
            <button type="button" class="btn btn-secondary"><a href="#">Create a tournament</a></button>
        </div>
    </div>
</div>
@endsection
