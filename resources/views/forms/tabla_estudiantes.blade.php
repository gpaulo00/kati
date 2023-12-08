<x-app-layout>
    <h4 class="mt-3 mb-4">Estudiantes</h4>
    <div class="row">
        <form method="get" action="{{ route('students') }}" class="row col-sm justify-content-between">
            <div class="col-sm-6">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar" aria-label="Buscar"
                        value="{{ Request::query('search') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary col-sm-2">
                Buscar &nbsp;
                <i class="fas fa-search"></i>
            </button>
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
                            <a role="button" href="{{ route('students.form.edit', $user->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
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
