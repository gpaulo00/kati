<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('bootstrap5.min.css') }}" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.15.4-web/css/all.css') }}" crossorigin="anonymous">

    <!-- Alpine Plugins -->
    <script defer src="{{ asset('alpine-mask.min.js') }}"></script>
    <!-- Alpine Core -->
    <script defer src="{{ asset('alpine.min.js') }}"></script>
    <style type="text/css">
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand text-center align-middle" href="#">
                <img src="{{ asset('logo.jpeg') }}" alt="" width="40" class="d-inline-block align-text-top">
                {{ config('app.community_name', 'Laravel') }}
            </a>

            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 ms-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Route::is('profile') ? 'active' : '' }}" href="#"
                            id="navbarProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Perfil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarProfile">
                            @if (!Session::get('auth_user')->superuser)
                            <li><a class="dropdown-item {{ Route::is('profile') ? 'active' : '' }}"
                                    href="{{ route('profile') }}">Información</a></li>
                            @endif
                            <li><a class="dropdown-item {{ Route::is('password') ? 'active' : '' }}"
                                    href="{{ route('password') }}">Cambiar Clave</a></li>
                        </ul>
                    </li>

                    @if (Session::get('auth_user')->superuser)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('students') ? 'active' : '' }}"
                            href="{{ route('students') }}">Estudiantes</a>
                    </li>
                    @endif

                    @if (Session::get('auth_user')->superuser)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('workers') ? 'active' : '' }}"
                            href="{{ route('workers') }}">Trabajadores</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('notifications') ? 'active' : '' }}"
                            href="{{ route('notifications') }}">Anuncios</a>
                    </li>

                    @if (!Session::get('auth_user')->superuser)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Constancias
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" target="_blank"
                                    href="{{ route('reports.estudios') }}">Constancia de Estudios</a></li>
                            <li><a class="dropdown-item" target="_blank"
                                    href="{{ route('reports.inscripcion') }}">Constancia de Inscripción</a></li>
                            {{-- <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Constancia de Egreso</a></li> --}}
                        </ul>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Información
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item {{ Route::is('mision') ? 'active' : '' }}" href="{{ route('mision') }}">Mision</a></li>
                            <li><a class="dropdown-item {{ Route::is('vision') ? 'active' : '' }}" href="{{ route('vision') }}">Visión</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>

            <div class="d-flex justify-content-end">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <form method="post" action="{{ route('auth.logout') }}">
                    @csrf
                    <button class="btn btn-outline-success ms-2" type="submit">Salir</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                {{ $slot }}
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap.bundle.min.js') }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
