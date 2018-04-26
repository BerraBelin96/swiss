<header class="masthead mb-auto">
	<div class="inner">
		@guest
		<a href="{{ route('home') }}">
		<h3 class="masthead-brand" id="logo">WorldofBoardGames.com</h3>
		</a>
		@else
		<a href="{{ route('admin.dashboard') }}">
		<h3 class="masthead-brand" id="logo">WorldofBoardGames.com</h3>
		</a>
		@endguest
		<nav class="nav nav-masthead justify-content-center">
			@guest
			<a class="nav-link active" href="{{ url('history') }}">Tournament History</a>
			<a class="nav-link active" href="{{ route('admin.login') }}">Log in</a>
			@else
				<li class="nav-item dropdown">
					<a id="dropdownMenuLink" class="dropdown-toggle active nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					{{ Auth::user()->name }} <span class="caret"></span>
					</a>

				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
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