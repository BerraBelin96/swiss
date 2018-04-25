@extends('layouts.master')
@section('content')
<div class="container-fluid">
	@guest
	@else
	<div>
		<div id="navbarToggleExternalContent" class="col-md-3 right">
			{{-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> --}}
			<form method="POST" action="/playerUpdate">
				{{ csrf_field() }}
				<input type="hidden" name="tournament" value="{{ $tournament }}">
				@foreach ($players as $player)
				<div class="input-group">
					<div class="form-check form-check-inline">
						<label class="form-check-label" for="">
						{{ $player->id }}. {{ $player->name }}
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input checkbox" type="checkbox" name="wins[]" id="wins" value="{{ $player->id }}">
						<label class="form-check-label" for="">
							Win
					</label>
					</div>
					<div class="form-check form-check-inline">
					<input class="form-check-input checkbox" type="checkbox" name="losses[]" id="losses" value="{{ $player->id }}">
					<label class="form-check-label" for="">
						Lose
					</label>
					</div>

				</div>
					<br>
			    @endforeach
			    <button type="submit" class="btn btn-default">Add</button>
			</form>
		</div>

		<button class="navbar-toggler" id="button" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span>open</span>
    	</button>

		<!-- Use any element to open the sidenav -->
		{{-- <span onclick="openNav()">open</span> --}}
	</div>
	@endguest
	<div class="row justify-content-center text-center">
		<div class="col-md-8">
			@foreach ($tournamentName as $Name)
			<h1 class="">{{ $Name->name }}</h1>
			@endforeach
			<hr>
			<div class="row">
				@foreach ($CurrentGame as $Current)
				<div class="col-md-6 playerName">
					<span>{{ $Current->playerOne }}. {{ $Current->p1_name }}</span>
					<span>vs</span>
					<span>{{ $Current->playerTwo }}. {{ $Current->p2_name }}</span>
				</div>
				@endforeach
				@foreach ($odd as $Odd)
					<span class="col-md-6">{{ $Odd->p1_name }} is waiting this round!</span>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection