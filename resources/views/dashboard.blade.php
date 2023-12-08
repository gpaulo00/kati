<x-app-layout>
    @php
        $user = Session::get('auth_user');
        $medical = $user->medicalData()->first();
    @endphp

    Bienvenido {{ $user->nombre }} {{ $user->apellido }}.

    <div class="row mt-5 justify-content-center">
        <div class="col-md-6" x-data="{ tab: 'personal' }" id="tab_wrapper">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a :class="{ 'nav-link': true, 'active': tab === 'personal' }" @click.prevent="tab = 'personal'" href="#">Datos Personales</a>
                </li>
                <li class="nav-item">
                    <a :class="{ 'nav-link': true, 'active': tab === 'educacion' }"  @click.prevent="tab = 'educacion'" href="#">Datos Educativos</a>
                </li>
                <li class="nav-item">
                    <a :class="{ 'nav-link': true, 'active': tab === 'medico' }" @click.prevent="tab = 'medico'" href="#">Datos Médicos</a>
                </li>
            </ul>

            <!-- info personal -->
            <table class="table" width="50%" x-show="tab === 'personal'">
                <tbody>
                    <tr>
                        <th>Nombre</th>
                        <td>{{ $user->nombre }}
                            {{ $user->apellido }}</td>
                    </tr>
                    <tr>
                        <th>C.I.</th>
                        <td>{{ $user->cedulaCompleto() }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de Nacimiento</th>
                        <td>{{ $user->fecha_nacimiento }}</td>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td>{{ $user->telefono }}</td>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <td>{{ $user->correo }}</td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td>{{ $user->direccion }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- info medica -->
            <table class="table" width="50%" x-show="tab === 'medico'" x-cloak>
                <tbody>
                    <tr>
                        <th>Tipo de Sangre</th>
                        <td>{{ $medical->tipo_sangre ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alérgias</th>
                        <td>{{ $medical->alergias ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Discapacidad</th>
                        <td>{{ $medical->discapacidad ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Enfermedades</th>
                        <td>{{ $medical->enfermedad ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- info educacion -->
            <table class="table" width="50%" x-show="tab === 'educacion'" x-cloak>
                <tbody>
                    <tr>
                        <th>Tipo Educación</th>
                        <td>{{ $user->tipo_educacion ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nivel</th>
                        <td>{{ $user->nivel_educacion ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de Inscripción</th>
                        <td>{{ $user->fecha_inscripcion ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <img src="https://api-private.atlassian.com/users/6b5c1609134a5887d7f3ab1b73557664/avatar">
        </div>
    </div>
</x-app-layout>
