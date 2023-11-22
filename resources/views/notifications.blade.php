<x-app-layout>
    <h4 class="mt-4">Información General</h4>
    <div class="accordion" id="accordionExample">
        @foreach ($notifications as $not)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $loop->index }}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}"
                    aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                    {{ $not->titulo }}
                </button>
            </h2>
            <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $loop->index }}"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    {{ $not->descripcion }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
