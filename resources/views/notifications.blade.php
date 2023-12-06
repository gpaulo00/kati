<x-app-layout>
    @if (Session::get('auth_user')->superuser)
        <table class="table" width="50%">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Creador</th>
                    <th>Fecha Creación</th>
                    <th></th>
                </tr>
                @foreach ($notifications as $not)
                <tr>
                    <th>{{ $not->id }}</th>
                    <td>{{ $not->titulo }}</td>
                    <td>{{ $not->descripcion }}</td>
                    <td>{{ $not->creador_por }}</td>
                    <td>{{ $not->created_at }}</td>
                    <td>
                        <button type="button" class="btn btn-danger"><span class="bi-trash"></span></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
