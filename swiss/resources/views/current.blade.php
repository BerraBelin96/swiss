@extends('layouts.master')
@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div id="mySidenav" class="sidenav">
			{{-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> --}}
			<form method="POST" action="/playerUpdate">
				{{ csrf_field() }}
				@foreach ($players as $player)
				<div class="input-group">
					<div class="form-check form-check-inline">
						<label class="form-check-label" for="">
						{{ $player->name }}
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="wins[]" id="wins" value="{{ $player->id }}">
						<label class="form-check-label" for="">
							Win
					</label>
					</div>
					<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" name="losses[]" id="losses" value="{{ $player->id }}">
					<label class="form-check-label" for="">
						Lose
					</label>
					</div>

				</div>
					<hr>
			    @endforeach
			    <button type="submit" class="btn btn-default">Add</button>
			</form>
		</div>

		<!-- Use any element to open the sidenav -->
		{{-- <span onclick="openNav()">open</span> --}}
	</div>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1 class="text-center">Current tournament</h1>
			<hr>
			<div class="text-center row">
				@foreach ($CurrentGame as $Current)
				<div class="col-md-6">
					<p>{{ $Current->playerOne }} vs {{ $Current->playerTwo }}</p>
				</div>
				</table>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection