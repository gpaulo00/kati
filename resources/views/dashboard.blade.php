<x-app-layout>

    Bienvenido {{ Session::get('auth_user')->nombre }} {{ Session::get('auth_user')->apellido }}.

    <div class="row mt-5 justify-content-center">
        <div class="col-md-5">
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
                        <td>{{ Session::get('auth_user')->telefono }}</td>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <td>{{ Session::get('auth_user')->correo }}</td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td>{{ Session::get('auth_user')->direccion }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <img src="https://api-private.atlassian.com/users/6b5c1609134a5887d7f3ab1b73557664/avatar">
        </div>
    </div>
</x-app-layout>
