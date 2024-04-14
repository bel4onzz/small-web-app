<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('logo.svg') }}" alt="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Small Web App</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav nav-underline justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <x-nav-link routeName="home">
                            Technical task
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link routeName="er-diagram">
                            ER Diagram
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link routeName="scoping-task">
                            Scoping Task
                        </x-nav-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
