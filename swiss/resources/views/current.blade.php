@extends('layouts.master')
@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1 class="text-center">Current tournament</h1>
			<hr>
			<div class="text-center">
				<table class="w-40 currentMatches"> 
					@foreach ($CurrentGame as $Current)
					<tbody>
						<tr>
							<td class="">{{$Current->playerOne}}</td>
							<td class="">VS</td>
							<td class="">{{$Current->playerTwo}}</td>
						</tr>
					</tbody>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>
@endsection