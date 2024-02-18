<x-app-layout>
    <h4 class="mt-3 mb-4">Trabajadores</h4>
    <div class="row">
        <form method="get" action="{{ route('workers') }}" class="row col-sm justify-content-between">
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar" aria-label="Buscar"
                        value="{{ Request::query('search') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary col-sm-1" data-toggle="tooltip" data-placement="top"
                                title="Buscar">
                <i class="fas fa-search"></i>
            </button>
            <a href="{{ route('workers.form.create') }}" class="btn btn-success col-sm-2" data-toggle="tooltip" data-placement="top"
                                title="Agregar Trabajador">
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
                    <th>Cargo</th>
                    <th>Turno</th>
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
                        <td>{{ $user->cargo }}</td>
                        <td>{{ $user->turno }}</td>
                        <td>
                            <a role="button" href="{{ route('workers.form.edit', $user->id) }}"
                                class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                                title="Editar"><i class="fas fa-edit"></i></a>

                            <a role="button" href="{{ route('reports.trabajo', ['id' => $user->id]) }}"
                                target="_blank" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"
                                title="Constancia de Trabajo"><i class="fas fa-file-pdf"></i></a>
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
