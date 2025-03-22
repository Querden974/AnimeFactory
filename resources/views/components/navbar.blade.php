<header class="navbar bg-base-100 shadow-sm justify-evenly">
    <a href="{{ route('home') }}" class=" normal-case text-xl">Anime Factory</a>
    <nav>
        <ul class="menu menu-horizontal">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('home') }}">Anime</a></li>
            <li><a href="{{ route('topAnime') }}">Top</a></li>
            <li><a href="{{ route('schedule') }}">Schedule</a></li>

        </ul>
    </nav>
    <div id="navbar-user">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0-18 0" />
                <path d="M9 10a3 3 0 1 0 6 0a3 3 0 1 0-6 0m-2.832 8.849A4 4 0 0 1 10 16h4a4 4 0 0 1 3.834 2.855" />
            </g>
        </svg>
    </div>
</header>
