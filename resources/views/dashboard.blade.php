<x-app-layout>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-sm-10 text-center">
                Bienvenido {{ Session::get('auth_user')->nombre }} {{ Session::get('auth_user')->apellido }}.

                <div class="row mt-5">
                    <div class="col-sm-5">
                        <table class="table" width="50%">
                            <tbody>
                                <tr>
                                    <th>Nombre</th>
                                    <td>{{ Session::get('auth_user')->nombre }}
                                        {{ Session::get('auth_user')->apellido }}</td>
                                </tr>
                                <tr>
                                    <th>C.I.</th>
                                    <td>{{ Session::get('auth_user')->cedula }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de Nacimiento</th>
                                    <td>{{ Session::get('auth_user')->fecha_nacimiento }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono</th>
                                    <td>{{ Session::get('auth_user')->fecha_nacimiento }}</td>
                                </tr>
                                <tr>
                                    <th>Correo</th>
                                    <td>{{ Session::get('auth_user')->fecha_nacimiento }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección</th>
                                    <td>{{ Session::get('auth_user')->fecha_nacimiento }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-3">
                        <img src="https://api-private.atlassian.com/users/6b5c1609134a5887d7f3ab1b73557664/avatar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
