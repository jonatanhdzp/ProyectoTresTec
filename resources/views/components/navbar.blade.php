<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Prueba Tres-Tec</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @php
                    $navItems = [
                        [
                            'title' => 'Inicio',
                            'href' => route('home'),
                            'active' => request()->routeIs('home') ? 'active' : '',
                        ],
                        [
                            'title' => 'Clientes',
                            'href' => route('client.index'),
                            'active' => request()->routeIs('client.*') ? 'active' : '',
                        ],
                    ];
                @endphp

                @foreach ($navItems as $navItem)
                    <li class="nav-item">
                        <a href="{{ $navItem['href'] }}" class="nav-link {{ $navItem['active'] }}">
                            {{ $navItem['title'] }}
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</nav>
