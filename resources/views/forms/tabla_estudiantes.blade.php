<x-app-layout>
    <div x-data='{
        user_id: null,
        availables: {!! json_encode([
            ["Constancia de Inscripción", route('reports.inscripcion', ['id' => ''])],
            ["Constancia de Estudios", route('reports.estudios', ['id' => ''])],
            ["Constancia de Retiro", route('reports.retiro', ['id' => ''])],
        ]) !!},
        motivoRetiro: null,
        representante: null,
        representanteCi: null,
        planilla: "0"
    }'>
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

                            <button @click='user_id = {{ $user->id }}' type="button"
                                data-bs-toggle="modal" data-bs-target="#planillas"
                                class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"
                                title="Constancia de Inscripción"><i class="fas fa-file-pdf"></i></button>
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

    <!-- planillas -->
    <div class="modal fade" id="planillas" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="planillasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="planillasLabel">
                        Descargar Constancia
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="planillaType" class="form-label">Tipo de Constancia</label>
                        <select x-model="planilla" id="planillaType" name="tipo_educacion" class="form-select">
                            <template x-for="(value, index) in availables">
                                <option :value="index" x-text="value[0]"></option>
                            </template>
                        </select>
                    </div>
                    <template x-if="planilla === '2'">
                        <div>
                            <div class="mb-3">
                                <label for="motivo" class="form-label">Motivo del Retiro</label>
                                <input for="motivoRetiro" x-model="motivoRetiro" type="text" class="form-control"
                                    required minlength="5" maxlength="50">
                            </div>

                            <div class="mb-3">
                                <label for="representante" class="form-label">Representante</label>
                                <input id="representante" x-model="representante" type="text" class="form-control"
                                    required minlength="5" maxlength="50">
                            </div>

                            <div class="mb-3">
                                <label for="representanteCi" class="form-label">C.I. Representante</label>
                                <input id="representanteCi" x-model="representanteCi" type="text" class="form-control"
                                    required minlength="5" maxlength="50">
                            </div>
                        </div>
                    </template>
                </div>
                <div class="modal-footer">
                    <a :href="`${availables[planilla][1]}${user_id}&motivo=${motivoRetiro}&representante=${representante}&ci=${representanteCi}`" target="_blank" class="btn btn-secondary">Generar</a>
                </div>
            </div>
        </div>
    </div>

    {{ $users->links() }}

    </div>
</x-app-layout>
