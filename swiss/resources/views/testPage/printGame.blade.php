<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
	<title>Print Games</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style type="text/css">
		p{
			font-size: 1.3em;
			font-family: "Times New Roman", Times, serif;
		}

		hr{
			border-color: black;
		}
	</style>
</head>
<body>
	<?php $i = 1; ?>
	@foreach ($CurrentGame as $Current)
		<hr>
		<div class="row">
			<div class="col-2">
				<p>Bord: {{ $i }}</p>
			</div>
			<div class="col">
				<p class="inline">ID: {{ $Current->playerOne }}</p>
				<p class="inline">Namn: {{ $Current->p1_name }}</p>
			</div>
			<div class="col">
				<p class="inline">Vann: ▢ </p>
				<p class="inline">Signatur: ____________________</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-2"></div>
			<div class="col">
				<p class="inline">ID: {{ $Current->playerTwo }}</p> 
				<p class="inline">Namn: {{ $Current->p2_name }}</p>
			</div>
			<div class="col">
				<p class="inline">Vann: ▢ </p>
				<p class="inline">Signatur: ____________________</p>
			</div>
		</div>
		<hr><br>
		<?php $i++; ?>
	@endforeach
	@foreach ($odd as $Odd)
		<hr>
		<div class="row">
			<div class="col-2">
				<p>Vänta</p>
			</div>
			<div class="col">
				<p>{{ $Odd->p1_name }} väntar den här rundan.</p>
			</div>
		</div>
		<hr>
	@endforeach
</body>
</html>