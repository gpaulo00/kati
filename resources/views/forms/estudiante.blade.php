<x-app-layout>
    <h4 class="mt-4">Información de Estudiante</h4>
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
            action="{{ isset($user) ? route('student.edit', $user->id) : route('student.create') }}" :class="{ 'row': true, 'g-3': true, 'mt-3': true }" novalidate>
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
                    <div class="form-floating"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-valid': processed,
                        }">
                        <input type="hidden" name="extranjero" :value="nacionalidad === 'E' ? 1 : 0">
                        <select required x-model="nacionalidad" id="st_nacionalidad" class="form-select"
                            :class="{ 'form-select': true, 'is-valid': processed }">
                            <option selected value='V'>Venezolano</option>
                            <option value="E">Extranjero</option>
                        </select>
                        <label for="st_nacionalidad">Nacionalidad</label>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <span class="input-group-text col-sm-2" x-text="nacionalidad">V</span>
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
                    <div class="form-floating col-sm-12"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-invalid': processed && errors.telefono,
                        }">
                        <input x-mask="(9999) 9999999" x-model="telefono" name="telefono" type="text" class="form-control"
                            :class="{
                                'form-control': true,
                                'is-valid': processed && !errors.telefono,
                                'is-invalid': processed && errors.telefono,
                            }" id="st_telefono">
                        <label for="st_telefono" class="form-label">Teléfono</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.telefono"></div>
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

            <h5 class="text-start">Datos Educativos</h5>
            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12">
                        <select required x-model="educacion" id="st_tipo_educacion" name="tipo_educacion"
                            :class="{ 'form-select': true, 'is-valid': processed }" class="form-select">
                            <option selected value='PRIMARIA'>PRIMARIA</option>
                        </select>
                        <label for="st_tipo_educacion">Tipo Educación</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-8">
                        <input type="hidden" name="nivel_educacion"
                            :value="`${nivel}º ${
                                                        (educacion === 'PRIMARIA') ? 'GRADO' :
                                                        (educacion === 'INICIAL') ? 'NIVEL' :
                                                        (educacion === 'BACHILLERATO') ? 'AÑO' : ''
                                                    }`">
                        <select required id="st_nivel" x-model="nivel" class="form-select"
                            :class="{ 'form-select': true, 'is-valid': processed }">
                            <option selected value='1'>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4" x-show="educacion !== 'INICIAL'">4</option>
                            <option value="5" x-show="educacion !== 'INICIAL'">5</option>
                            <option value="6" x-show="educacion === 'PRIMARIA'">6</option>
                        </select>
                        <label for="st_nivel">Curso Actual</label>
                    </div>
                    <span class="input-group-text col-sm-4" x-show="educacion === 'PRIMARIA'">GRADO</span>
                    <span class="input-group-text col-sm-4" x-cloak x-show="educacion === 'INICIAL'">NIVEL</span>
                    <span class="input-group-text col-sm-4" x-cloak x-show="educacion === 'BACHILLERATO'">AÑO</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-invalid': processed && errors.fecha_inscripcion,
                        }">
                        <input id="st_fecha_inscripcion" class="form-control" type="date"
                            name="fecha_inscripcion" x-model="fecha_inscripcion"
                            max="{{ date('Y-m-d'); }}"
                            :class="{
                                'form-control': true,
                                'is-valid': processed && !errors.fecha_inscripcion,
                                'is-invalid': processed && errors.fecha_inscripcion,
                            }" />
                        <label for="st_fecha_inscripcion">Fecha de Inscripción</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.fecha_inscripcion"></div>
                </div>
            </div>

            <div>
                @if(isset($user))
                    <button type="button"
                        data-bs-toggle="modal" data-bs-target="#planillas"
                        class="btn btn-info" data-toggle="tooltip" data-placement="top"
                        title="Planillas">Planillas &nbsp;<i class="fas fa-file-pdf"></i></button>
                @endif
                <a role="button" href="{{ route('students') }}" class="btn btn-secondary">Volver</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
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
                            <a :href="getPlanillaLink()" target="_blank" class="btn btn-secondary">Generar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        function validatePhone(email) {
            var re2 = /^\((02\d\d|0414|0424|0412|0416|0426)\) [0-9]{7}$/;
            return re2.test(email);
        }

        function creditCardMask(input) {
            return '9'.repeat(input.length < 10 ? input.length + 1 : 10)
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('estudiante', () => ({
                errors: {},
                nacionalidad: '{{ isset($user) && $user->extranjero ? 'E' : 'V' }}',
                sexo: '{{ isset($user) && $user->sexo ? 'F' : 'M' }}',
                correo: @json($user->correo ?? null),
                nombre: @json($user->nombre ?? null),
                apellido: @json($user->apellido ?? null),
                cedula: @json($user->cedula ?? null),
                telefono: @json($user->telefono ?? null),
                fecha_nacimiento: @json($user->fecha_nacimiento ?? null),
                educacion: @json($user->tipo_educacion ?? 'PRIMARIA'),
                nivel: @json(isset($user) && !is_null($user->nivel_educacion) ? (int)$user->nivel_educacion : 1),
                fecha_inscripcion: @json($user->fecha_inscripcion ?? null),
                processed: false,
                availables: {!! json_encode(isset($user) ? [
                    ["Constancia de Inscripción", route('reports.inscripcion', ['id' => $user->id])],
                    ["Constancia de Estudios", route('reports.estudios', ['id' => $user->id])],
                    ["Constancia de Retiro", route('reports.retiro', ['id' => $user->id])],
                    ["Constancia de Prosecución", route('reports.prosecucion', ['id' => $user->id])]
                ] : []) !!},
                planilla: '0',
                motivoRetiro: null,
                representante: null,
                representanteCi: null,

                getPlanillaLink() {
                    let link = this.availables[this.planilla][1];
                    if (this.planilla === '2') {
                        link += `&motivo=${encodeURI(this.motivoRetiro)}&representante=${encodeURI(this.representante)}&ci=${encodeURI(this.representanteCi)}`;
                    }
                    return link;
                },

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
                    if (!this.fecha_nacimiento) {
                        this.errors.fecha_nacimiento = 'Este campo es obligatorio';
                    }
                    if (!this.fecha_inscripcion) {
                        this.errors.fecha_inscripcion = 'Este campo es obligatorio';
                    }
                    const fecha_max = moment().add(-4, 'year') // fecha actual - 4 años = 2020
                    const fecha_min = moment().add(-20, 'year') // fecha actual - 20 años = 2004
                    if (this.fecha_nacimiento && moment(this.fecha_nacimiento).isAfter(fecha_max)) {
                        this.errors.fecha_nacimiento = 'Fecha inválida';
                    }
                    if (this.fecha_nacimiento && moment(this.fecha_nacimiento).isBefore(fecha_min)) {
                        this.errors.fecha_nacimiento = 'Fecha inválida';
                    }

                    if (this.telefono && !validatePhone(this.telefono)) {
                        this.errors.telefono = 'No es un teléfono válido';
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
