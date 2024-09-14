<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ url('bootstrap4.min.css') }}" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('fontawesome-free-5.15.4-web/css/all.css') }}" crossorigin="anonymous">
    <script src="{{ url('jquery.slim.min.js') }}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="{{ url('bootstrap4.bundle.min.js') }}" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script defer src="{{ url('alpine-mask.min.js') }}"></script>
    <script defer src="{{ url('alpine.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('login.css') }}">
    <style type="text/css">
    .gp-card {
        width: 100%;
        margin-top: 20px;
    }
    </style>
</head>
<!------ Include the above in your HEAD tag ---------->

<body>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-sm justify-content-center">
                <div class="user_card gp-card">
                <div class="row mt-4">
                    <div class="col-sm-4">
                        <img src="{{ asset('logo.jpeg') }}" alt="Logo" width="100%">
                    </div>
                    <div class="col-sm mr-2" style="padding: 0; d-flex justify-content-center">
                        <h3 class="text-center text-uppercase">{{ config('app.community_name', 'Laravel') }}</h3>
                    </div>
                </div>

                <br /><br />
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" style="max-height: 350px;">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/fachada1.jpg') }}" alt="Fachada 1">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/fachada2.jpg') }}" alt="Fachada 2">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/fachada3.jpg') }}" alt="Fachada 3">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                    </div>
                </div>
            </div>

            <div class="col-sm h-100">
                <div class="container h-100">
                    <div class="d-flex justify-content-center h-100">
                        <div class="user_card">
                            <div class="d-flex justify-content-center">
                                <div class="brand_logo_container">
                                    <img src="{{ asset('default-avatar.png') }}" class="brand_logo" alt="Logo">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center form_container">
                                <form method="POST" action="{{ route('auth.login') }}" x-data>
                                    @csrf
                                    <div class="input-group mb-3 mt-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input
                                            required
                                            x-mask:dynamic="creditCardMask"
                                            minlength="4"
                                            autocomplete="off"
                                            type="text" name="username" class="form-control input_user"
                                            value="{{ $user ?? '' }}"
                                            placeholder="C.I."
                                        >
                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input required type="password" name="password" minlength="8" class="form-control input_pass" placeholder="Contraseña">
                                    </div>
                                    {{--
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Recuérdame</label>
                                        </div>
                                    </div>
                                    --}}
                                    <div class="d-flex justify-content-center mt-5 mb-3 login_container">
                                        <input type="submit" name="button" class="btn login_btn" value="Iniciar">
                                    </div>
                                </form>
                            </div>
                            
                            @if (isset($error))
                            <div class="mt-4 alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                            @endif

{{--
                            <div class="mt-2">
                                <div class="d-flex justify-content-center links">
                                    No estás registrado aún? <a href="#" class="ml-2">Regístrate!</a>
                                </div>
                                <div class="d-flex justify-content-center links">
                                    <a href="#">Olvidó su contraseña?</a>
                                </div>
                            </div>
                            --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function creditCardMask(input) {
            return '9'.repeat(input.length < 10 ? input.length + 1 : 10)
        }
    </script>
</body>

</html>