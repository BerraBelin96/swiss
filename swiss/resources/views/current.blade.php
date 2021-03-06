@extends('layouts.master')
@section('content')
<div class="container-fluid">
	@guest
	@else
	<div>
		<div id="navbarToggleExternalContent" class="col-md-3 right">
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
				<button type="submit" name="action" value="Next" class="btn btn-secondary">Next</button>
				<button type="submit" name="action" value="End" class="btn btn-secondary">End</button>
				<a class="btn btn-secondary" href="{{ URL::to('/reShuffle/'.$tournament) }}">Reshuffle</a>
				<a class="btn btn-secondary" href="{{ URL::to('/printGame/'.$tournament) }}" target="_blank">Print out</a>
			</form>
			<br>
		</div>
		<div class="center">
		<button class="navbar-toggler" id="button" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icon">&equiv;</span>
		</button>
		</div>

		<!-- Use any element to open the sidenav -->
	</div>
	@endguest
	<div class="row justify-content-center text-center">
		<div class="col-md-8">
			@foreach ($tournamentName as $Name)
			<h1 class="">{{ $Name->name }}</h1>
			<hr>
			<h2>Round {{ $Name->current_round }}</h2>
			<br>
			@endforeach
			<div class="row">
				@foreach ($CurrentGame as $index => $Current)
				@if (count($CurrentGame) <= 2)
				<div class="col-md-6 playerName">
					@elseif (count($CurrentGame) === 3)
					<div class="col-md-4 playerName">
						@elseif (count($CurrentGame) === 4)
						<div class="col-md-6 playerName">
							@else
							<div class="col-md-4 playerName">
								@endif
								<h3>Table {{ $index+1 }}</h3>
								@guest
								<p class="mb-0">{{ $Current->p1_name }} ({{ $Current->p1_wins }}/{{ $Current->p1_losses }})</p>
								<p>{{ $Current->p2_name }} ({{ $Current->p2_wins }}/{{ $Current->p2_losses }})</p>
								@else
								<p class="mb-0">{{ $Current->playerOne }}. {{ $Current->p1_name }} ({{ $Current->p1_wins }}/{{ $Current->p1_losses }})</p>
								<p>{{ $Current->playerTwo }}. {{ $Current->p2_name }} ({{ $Current->p2_wins }}/{{ $Current->p2_losses }})</p>
								@endguest
							</div>
							@endforeach
							@foreach ($odd as $Odd)
							<p class="col-md-6">{{ $Odd->p1_name }} ({{ $Odd->p1_wins }}/{{ $Odd->p1_losses }}) is waiting this round!</p>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@endsection