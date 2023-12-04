<x-app-layout>
    <div class="row mt-5 justify-content-center">
        <div class="card  col-md-6">
            <div class="card-body">
                <h5 class="card-title">Actualización de Contraseña</h5>

                <form x-data="otro" x-ref="myform" @submit="validate"
                    method="post" action="{{ route('password.change') }}"
                    :class="{ 'row': true, 'g-3': true, 'mt-3': true }" novalidate>
                    @csrf
                    <div class="col-sm-12">
                        <div class="input-group has-validation">
                            <div class="form-floating col-sm-12"
                                :class="{
                                    'form-floating': true,
                                    'col-sm-12': true,
                                    'is-valid': processed && !errors.antigua,
                                    'is-invalid': processed && errors.antigua,
                                }">
                                <input type="text" class="form-control"
                                    name="password"
                                    :class="{
                                        'form-control': true,
                                        'is-valid': processed && !errors.antigua,
                                        'is-invalid': processed && errors.antigua,
                                    }"
                                    id="stOldPass" x-model="antigua" minlength="8" required>
                                <label for="stOldPass" class="form-label">Contraseña</label>
                            </div>
                            <div class="invalid-feedback" x-text="errors.antigua"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group has-validation">
                            <div class="form-floating col-sm-12"
                                :class="{
                                    'form-floating': true,
                                    'col-sm-12': true,
                                    'is-invalid': processed && errors.nueva,
                                }">
                                <input type="text" x-ref="nueva" class="form-control"
                                    name="confirm"
                                    :class="{
                                        'form-control': true,
                                        'is-valid': processed && !errors.nueva,
                                        'is-invalid': processed && errors.nueva,
                                    }"
                                    id="stNewPass" x-model="nueva" minlength="8" required>
                                <label for="stNewPass" class="form-label">Confirmación</label>
                            </div>
                            <div class="invalid-feedback" x-text="errors.nueva"></div>
                        </div>
                    </div>
                    @if (isset($message))
                    <div class="mt-4 alert alert-sucess" role="alert">
                        {{ $message }}
                    </div>
                    @endif
                    @if (isset($error))
                    <div class="mt-4 alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                    @endif
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Procesar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {
            Alpine.data('otro', () => ({
                antigua: '',
                nueva: '',
                errors: {},
                processed: false,

                validate(e) {
                    this.errors = {};
                    if (!this.antigua || this.antigua === '') {
                        this.errors.antigua = 'Este campo es obligatorio';
                    } else if (this.antigua.length < 8) {
                        this.errors.antigua = 'Debe tener mínimo 8 caracteres';
                    }

                    if (!this.nueva || this.nueva === '') {
                        this.errors.nueva = 'Este campo es obligatorio';
                    } else if (this.antigua !== this.nueva) {
                        this.errors.nueva = 'Las contraseñas no coinciden';
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
