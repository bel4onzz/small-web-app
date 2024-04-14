@props(['routeName'])

<a class="nav-link {{ Request::routeIs($routeName) ? 'active' : '' }}" href="{{ route($routeName) }}">
    {{ $slot }}
</a>
