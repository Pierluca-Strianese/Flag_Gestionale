@php
    $user = Auth::user();
@endphp

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container-xxl">
        <a class="navbar-brand" href="{{ route('guests.home') }}">Boolfolio</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="{{ route('dashboard.customers.index') }}">Clienti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </div>

    </div>
</nav>
