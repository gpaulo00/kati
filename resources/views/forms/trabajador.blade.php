<x-app-layout>
    <h4 class="mt-4">Información del Trabajador</h4>
    <div class="row">
        @if (Session::has('message'))
            <div class="row justify-content-center">
                <div class="mt-3 mb-3 col-sm-5 alert alert-dismissible {{ Session::get('alert-class', 'alert-info') }}"
                    role="alert">
                    <div>{{ Session::get('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            </div>
        @endif

        <form x-data="estudiante" x-ref="myform" @submit="validate" method="post"
            action="{{ isset($user) ? route('worker.edit', $user->id) : route('worker.create') }}" :class="{ 'row': true, 'g-3': true, 'mt-3': true }" novalidate>
            @csrf
            <h5 class="text-start">Datos Personales</h5>
            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-valid': processed && !errors.nombre,
                            'is-invalid': processed && errors.nombre,
                        }">
                        <input type="text" class="form-control" name="nombre"
                            :class="{
                                'text-uppercase': true,
                                'form-control': true,
                                'is-valid': processed && !errors.nombre,
                                'is-invalid': processed && errors.nombre,
                            }"
                            id="st_nombres" x-model="nombre" required>
                        <label for="st_nombres" class="form-label">Nombres</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.nombre"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-invalid': processed && errors.apellido,
                        }">
                        <input type="text" class="form-control" name="apellido"
                            :class="{
                                'text-uppercase': true,
                                'form-control': true,
                                'is-valid': processed && !errors.apellido,
                                'is-invalid': processed && errors.apellido,
                            }"
                            id="st_apellidos" x-model="apellido" required>
                        <label for="st_apellidos" class="form-label">Apellidos</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.apellido"></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <span class="input-group-text col-sm-2">V</span>
                    <div class="form-floating col-sm-10"
                        :class="{
                            'form-floating': true,
                            'col-sm-10': true,
                            'is-invalid': processed && errors.cedula,
                        }">
                        <input x-mask:dynamic="creditCardMask" type="text" class="form-control" name="cedula"
                            :class="{
                                'form-control': true,
                                'is-valid': processed && !errors.cedula,
                                'is-invalid': processed && errors.cedula,
                            }"
                            id="st_cedula" x-model="cedula" required>
                        <label for="st_cedula" class="form-label">C.I.</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.cedula"></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-invalid': processed && errors.fecha_nacimiento,
                        }">
                        <input id="st_fecha_nacimiento" name="fecha_nacimiento" x-model="fecha_nacimiento"
                            max="{{ date('Y-m-d'); }}"
                            class="form-control" type="date"
                            :class="{
                                'form-control': true,
                                'is-valid': processed && !errors.fecha_nacimiento,
                                'is-invalid': processed && errors.fecha_nacimiento,
                            }"
                            required />
                        <label for="st_fecha_nacimiento">Fecha de Nacimiento</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.fecha_nacimiento"></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12">
                        <input x-mask="(9999) 9999999" value="{{ $user->telefono ?? '' }}" name="telefono" type="text" class="form-control"
                            :class="{ 'form-control': true, 'is-valid': processed }" id="st_telefono">
                        <label for="st_telefono">Teléfono</label>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-invalid': processed && errors.correo,
                        }">
                        <input type="text" class="form-control" name="correo"
                            :class="{
                                'form-control': true,
                                'is-valid': processed && !errors.correo,
                                'is-invalid': processed && errors.correo,
                            }"
                            id="st_correo" x-model="correo">
                        <label for="st_correo" class="form-label">Correo</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.correo"></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-valid': processed,
                        }">
                        <input type="hidden" name="sexo" :value="sexo === 'F' ? 1 : 0">
                        <select required x-model="sexo" id="st_sexo" class="form-select"
                            :class="{ 'form-select': true, 'is-valid': processed }">
                            <option selected value='M'>Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        <label for="st_sexo">Sexo</label>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12">
                        <textarea :class="{ 'form-control': true, 'is-valid': processed }" class="form-control" name="direccion"
                            id="st_dirrecion" rows="5">{{ $user->direccion ?? '' }}</textarea>
                        <label for="st_dirrecion">Dirección</label>
                    </div>
                </div>
            </div>

            <h5 class="text-start">Datos Laborales</h5>
            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12">
                        <select required x-model="turno" id="st_turno" name="turno"
                            :class="{ 'form-select': true, 'is-valid': processed }" class="form-select">
                            <option selected value='MAÑANA'>MAÑANA</option>
                            <option value="TARDE">TARDE</option>
                            <option value="NOCHE">NOCHE</option>
                        </select>
                        <label for="st_turno">Turno</label>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-invalid': processed && errors.cargo,
                        }">
                        <input type="text" class="form-control" name="cargo"
                            :class="{
                                'text-uppercase': true,
                                'form-control': true,
                                'is-valid': processed && !errors.cargo,
                                'is-invalid': processed && errors.cargo,
                            }"
                            id="st_cargo" x-model="cargo">
                        <label for="st_cargo" class="form-label">Cargo</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.cargo"></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-invalid': processed && errors.fecha_ingreso,
                        }">
                        <input id="st_fecha_ingreso" class="form-control" type="date"
                            name="fecha_ingreso" x-model="fecha_ingreso"
                            max="{{ date('Y-m-d'); }}"
                            :class="{
                                'form-control': true,
                                'is-valid': processed && !errors.fecha_ingreso,
                                'is-invalid': processed && errors.fecha_ingreso,
                            }" />
                        <label for="st_fecha_ingreso">Fecha de Ingreso</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.fecha_ingreso"></div>
                </div>
            </div>

            <div>
                @if(isset($user))
                    <a role="button" href="{{ route('reports.trabajo', ['id' => $user->id]) }}"
                                    target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top"
                                    title="Constancia de Trabajo">Constancia de Trabajo &nbsp;<i class="fas fa-file-pdf"></i></a>
                @endif
                <a role="button" href="{{ route('workers') }}" class="btn btn-secondary">Volver</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        function creditCardMask(input) {
            return '9'.repeat(input.length < 10 ? input.length + 1 : 10)
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('estudiante', () => ({
                errors: {},
                sexo: '{{ isset($user) && $user->sexo ? 'F' : 'M' }}',
                correo: @json($user->correo ?? null),
                cargo: @json($user->cargo ?? null),
                nombre: @json($user->nombre ?? null),
                apellido: @json($user->apellido ?? null),
                cedula: @json($user->cedula ?? null),
                fecha_nacimiento: @json($user->fecha_nacimiento ?? null),
                turno: @json($user->turno ?? 'MAÑANA'),
                fecha_ingreso: @json($user->fecha_ingreso ?? null),
                processed: false,

                validate(e) {
                    this.errors = {};
                    if (!this.nombre) {
                        this.errors.nombre = 'Este campo es obligatorio';
                    }
                    if (!this.apellido) {
                        this.errors.apellido = 'Este campo es obligatorio';
                    }
                    if (!this.cedula) {
                        this.errors.cedula = 'Este campo es obligatorio';
                    } else if (this.cedula.length < 5) {
                        this.errors.cedula = 'La cédula es inválida'
                    }
                    if (!this.cargo) {
                        this.errors.cargo = 'Este campo es obligatorio';
                    }
                    if (!this.fecha_nacimiento) {
                        this.errors.fecha_nacimiento = 'Este campo es obligatorio';
                    }
                    if (!this.fecha_ingreso) {
                        this.errors.fecha_ingreso = 'Este campo es obligatorio';
                    }

                    if (!this.correo) {
                        this.errors.correo = 'Este campo es obligatorio';
                    } else if (!validateEmail(this.correo)) {
                        this.errors.correo = 'No es un correo válido';
                    }

                    this.processed = true;
                    if (Object.keys(this.errors).length > 0) {
                        e.preventDefault();
                    }
                }
            }))
        });
    </script>
</x-app-layout>
