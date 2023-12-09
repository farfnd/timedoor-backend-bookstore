<!DOCTYPE html>
<html lang="en">

@php
    $pages = [
        'Top Books' => '/',
        'Top 10 Authors' => 'top-authors',
        'Input Rating' => 'input-rating',
    ];
@endphp

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-light p-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            @foreach ($pages as $page => $url)
                                <a class="nav-link{{ Request::is($url) ? ' active' : '' }}"
                                    href="{{ $url }}">{{ $page }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="my-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>

</html>
