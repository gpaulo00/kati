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
            action="{{ route('student.create') }}" :class="{ 'row': true, 'g-3': true, 'mt-3': true }" novalidate>
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
                    <div class="form-floating col-sm-12">
                        <input x-mask="(9999) 9999999" name="telefono" type="text" class="form-control"
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

            <div class="col-md-8">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12">
                        <textarea :class="{ 'form-control': true, 'is-valid': processed }" class="form-control" name="direccion"
                            id="st_dirrecion" rows="5"></textarea>
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
                            <option value="INICIAL">INICIAL</option>
                            <option value="BACHILLERATO">BACHILLERATO</option>
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

            <div class="col-md-3">
                <div class="input-group has-validation">
                    <div class="form-floating col-sm-12"
                        :class="{
                            'form-floating': true,
                            'col-sm-12': true,
                            'is-invalid': processed && errors.periodo_escolar,
                        }">
                        <input x-mask="9999-9999" name="periodo_escolar" type="text" x-model="periodo_escolar"
                            class="form-control" id="st_periodo_escolar" placeholder="20XX-20XY" required
                            :class="{
                                'form-control': true,
                                'is-valid': processed && !errors.periodo_escolar,
                                'is-invalid': processed && errors.periodo_escolar,
                            }">
                        <label for="st_periodo_escolar">Periodo Escolar</label>
                    </div>
                    <div class="invalid-feedback" x-text="errors.periodo_escolar"></div>
                </div>
            </div>

            <div>
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
                nacionalidad: 'V',
                correo: null,
                cedula: null,
                educacion: 'PRIMARIA',
                apellido: null,
                fecha_nacimiento: null,
                periodo_escolar: null,
                fecha_inscripcion: null,
                nombre: null,
                processed: false,

                nivel: 1,

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
                    if (!this.periodo_escolar) {
                        this.errors.periodo_escolar = 'Este campo es obligatorio';
                    }
                    if (!this.fecha_inscripcion) {
                        this.errors.fecha_inscripcion = 'Este campo es obligatorio';
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
