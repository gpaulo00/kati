<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('login.css') }}">
</head>
<!------ Include the above in your HEAD tag ---------->

<body>
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-sm justify-content-center">
                <div class="row mt-4">
                    <div class="col-sm-3">
                        <img src="{{ asset('logo.jpeg') }}" alt="Logo" width="100%">
                    </div>
                    <div class="col-sm">
                        <h2 class="text-center">Complejo Educativo Hermanas Peraza</h2>
                    </div>
                </div>

                @isset($notifications)
                <h4 class="mt-4">Información</h4>
                <div class="accordion" id="accordionExample">
                    @foreach ($notifications as $not)
                    <div class="card">
                        <div class="card-header" id="heading{{ $loop->index }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                            {{ $not->titulo }}
                            </button>
                        </h2>
                        </div>

                        <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            {{ $not->descripcion }}
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endisset
            </div>

            <div class="col-sm h-100">
                <div class="container h-100">
                    <div class="d-flex justify-content-center h-100">
                        <div class="user_card">
                            <div class="d-flex justify-content-center">
                                <div class="brand_logo_container">
                                    <img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center form_container">
                                <form method="POST" action="/login">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input required type="text" name="username" class="form-control input_user" value="{{ $user ?? '' }}" placeholder="Usuario">
                                    </div>
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input required type="password" name="password" class="form-control input_pass" placeholder="Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Recuérdame</label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3 login_container">
                                        <input type="submit" name="button" class="btn login_btn" value="Iniciar">
                                    </div>
                                </form>
                            </div>
                            
                            @if (isset($error))
                            <div class="mt-4 alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                            @endif

                            <div class="mt-2">
                                <div class="d-flex justify-content-center links">
                                    No estás registrado aún? <a href="#" class="ml-2">Regístrate!</a>
                                </div>
                                <div class="d-flex justify-content-center links">
                                    <a href="#">Olvidó su contraseña?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>