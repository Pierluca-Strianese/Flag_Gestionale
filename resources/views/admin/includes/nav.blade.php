@php
    $user = Auth::user();
@endphp

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container-xxl">
        <a class="navbar-brand" href="{{ route('guests.home') }}">Boolfolio</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
