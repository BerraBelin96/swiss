@extends ('layouts.master')

@section ('content')
	<div class="col-sm-8 blog-main">
		<h1>Add names</h1>

		<hr>

		<form method="POST" action="/addname">
		{{ csrf_field() }}

			<div class="form-group">
				<label for="title">Name:</label>
				<input type="text" class="form-control" id="name" name="name">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">add</button>
			</div>
			
			@include('layouts.errors')
		</form>
		<a href="">Start</a>
		@foreach ($players as $player)
            {{ $player->name }} <br>
        @endforeach
	</div>
@endsection