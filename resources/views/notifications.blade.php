<x-app-layout>
    @if (Session::get('auth_user')->superuser)
        <div x-data="{ item: {} }">
            @if (Session::has('message'))
                <div class="row justify-content-center">
                    <div class="mt-4 mb-3 col-sm-5 alert {{ Session::get('alert-class', 'alert-info') }}" role="alert">
                        {{ Session::get('message') }}
                    </div>
                </div>
            @endif

            <table class="table" width="50%">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Creador</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($notifications as $not)
                        <tr>
                            <th>{{ $not->id }}</th>
                            <td>{{ $not->titulo }}</td>
                            <td>{{ $not->descripcion }}</td>
                            <td>{{ $not->creado_por }}</td>
                            <td>{{ $not->created_at }}</td>
                            <td>
                                <button @click='item = @json($not)' type="button"
                                    class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDialog"><i
                                        class="fas fa-trash"></i></button>
                                <button @click='item = @json($not)' type="button"
                                    class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row justify-content-end">
                <button type="button" @click='item = {}' class="col-sm-2 btn btn-sm btn-success" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                    Agregar &nbsp;
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <!-- edit dialog -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" method="post"
                        :action="item.id ? `{{ route('notifications.edit', '') }}/${item.id}` : `{{ route('notifications.create') }}`">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                <span x-text="item.id ? 'Editar' : 'Crear'"></span>
                                Notificación
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="creado_por" value="{{ Session::get('auth_user')->nombreCompleto() }}">
                            <div class="mb-3">
                                <label for="notTitulo" class="form-label">Título</label>
                                <input x-model="item.titulo" type="text" name="titulo" class="form-control"
                                    id="notTitulo" required minlength="5" maxlength="50">
                            </div>
                            <div class="mb-3">
                                <label for="notDescription" class="form-label">Descripción</label>
                                <textarea x-model="item.descripcion" class="form-control" name="descripcion" id="notDescription" required rows="3"
                                    minlength="10" maxlength="255"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" x-text="item.id ? 'Editar' : 'Crear'"></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- delete dialog -->
            <div class="modal fade" id="deleteDialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="deleteDialogLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" method="post"
                        :action="`{{ route('notifications.delete', '') }}/${item.id}`">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteDialogLabel">Eliminar Notificación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>
                                ¿Estás seguro de eliminar la notificación <span class="fw-bolder"
                                    x-text="item.titulo"></span>"?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <h4 class="mt-4">Información General</h4>
        <div class="accordion" id="accordionExample">
            @foreach ($notifications as $not)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $loop->index }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $loop->index }}" aria-expanded="true"
                            aria-controls="collapse{{ $loop->index }}">
                            {{ $not->titulo }}
                        </button>
                    </h2>
                    <div id="collapse{{ $loop->index }}"
                        class="accordion-collapse collapse {{ $loop->index == 0 ? 'show' : '' }}"
                        aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {{ $not->descripcion }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
