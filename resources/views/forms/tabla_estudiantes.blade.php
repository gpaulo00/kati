<x-app-layout>
    <h4 class="mt-3 mb-4">Estudiantes</h4>
    <div class="row">
        <form method="get" action="{{ route('students') }}" class="row col-sm justify-content-between">
            <div class="col-sm-5">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar" aria-label="Buscar"
                        value="{{ Request::query('search') }}">
                </div>
            </div>
            <div class="col-sm-3">
                <select class="form-select" name="nivel_educacion">
                    <option {{ Request::query('nivel_educacion') != null ? '' : 'selected' }} value=''>Nivel
                        Educativo</option>
                    @foreach (['GRADO'] as $grado)
                        @for ($i = 1; $i <= ($grado == 'NIVEL' ? 3 : 6); $i++)
                            <option {{ Request::query('nivel_educacion') == $i . 'º ' . $grado ? 'selected' : '' }}
                                value="{{ $i }}º {{ $grado }}">{{ $i }}º
                                {{ $grado }}</option>
                        @endfor
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary col-sm-1" data-toggle="tooltip" data-placement="top"
                                title="Buscar">
                <i class="fas fa-search"></i>
            </button>
            <a href="{{ route('students.form.create') }}" class="btn btn-success col-sm-2" data-toggle="tooltip" data-placement="top"
                                title="Agregar Estudiante">
                Agregar &nbsp;
                <i class="fas fa-plus"></i>
            </a>
        </form>
    </div>
    <div class="row mt-4">
        <table id="students" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>C.I.</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Curso Actual</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->cedulaCompleto() }}</td>
                        <td>{{ $user->nombre }}</td>
                        <td>{{ $user->apellido }}</td>
                        <td>{{ $user->telefono }}</td>
                        <td>{{ $user->nivel_educacion }}</td>
                        <td>
                            <a role="button" href="{{ route('students.form.edit', $user->id) }}"
                                class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                title="Editar"><i class="fas fa-edit"></i></a>

                            <a role="button" href="{{ route('reports.inscripcion', ['id' => $user->id]) }}"
                                target="_blank" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"
                                title="Constancia de Inscripción"><i class="fas fa-file-pdf"></i></a>
                            <a role="button" href="{{ route('reports.estudios', ['id' => $user->id]) }}"
                                target="_blank" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"
                                title="Constancia de Estudios"><i class="fas fa-file-pdf"></i></a>
                        </td>
                    </tr>
                @endforeach
                @if (count($users) == 0)
                    <tr>
                        <td class="fs-3 pt-3 pb-3" colspan="6">No hay resultados para su búsqueda</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</x-app-layout>
