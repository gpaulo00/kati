<x-app-layout>
    <h4 class="mt-3 mb-4">Buscar Trabajador</h4>
    <div class="row mb-4">
        @if (Session::has('message'))
            <div class="row justify-content-center">
                <div class="mt-3 mb-3 col-sm-5 alert alert-dismissible {{ Session::get('alert-class', 'alert-info') }}"
                    role="alert">
                    <div>{{ Session::get('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            </div>
        @endif

        <form method="get" action="{{ route('workers.search') }}" class="row col-sm justify-content-center pt-4">
            <div class="col-sm-5">
                <div class="input-group">
                    <input type="text"
                        required
                        class="form-control"
                        name="cedula"
                        placeholder="Cédula de Identidad">
                </div>
            </div>

            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary mr-2" data-toggle="tooltip" data-placement="top"
                                    title="Buscar">
                    Buscar &nbsp;   
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ route('workers.form.create') }}" class="ml-2 btn btn-success" data-toggle="tooltip" data-placement="top"
                                    title="Agregar Trabajador">
                    Agregar &nbsp;
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </form>
    </div>
    <br />
    <div class="row mt-5 justify-content-center">
        <div class="col-sm-4">
            <img src="{{ asset('logo.jpeg') }}" alt="Logo" width="100%">
        </div>
    </div>
</x-app-layout>
