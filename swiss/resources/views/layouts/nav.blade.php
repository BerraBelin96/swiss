<header class="masthead mb-auto">
	<div class="inner">
		<h3 class="masthead-brand">WorldOfBoardGames</h3>
		<nav class="nav nav-masthead justify-content-center">
			<ul class="navbar-nav nav-link">
			@guest
			<a class="nav-link active" href="{{ url('/') }}">Home</a>
			<li><a href="{{ route('admin.login') }}">Log in</a></li>
			@else
				<li class="nav-item dropdown">
					<a id="dropdownMenuLink" class="dropdown-toggle active" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					{{ Auth::user()->name }} <span class="caret"></span>
					</a>

				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="{{ route('logout') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
					{{ __('Logout') }}
					</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
				</div>
		</li>
		@endguest
	</ul>
	</nav>
</div>
</header>