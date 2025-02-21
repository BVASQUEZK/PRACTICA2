@extends('plantilla.app')

@section('contenido')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-light text-center rounded-top-4">
                    <h3 class="mb-0 fw-bold">Editar Usuario</h3>
                </div>
                <div class="card-body p-4 bg-light text-dark">
                    <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-dark">Nombre</label>
                            <input type="text" class="form-control bg-secondary text-white border-light @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Correo -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-dark">Correo</label>
                            <input type="email" class="form-control bg-secondary text-white border-light @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nueva Contraseña -->
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label fw-semibold text-dark">Nueva Contraseña (opcional)</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-secondary text-white border-light @error('password') is-invalid @enderror" 
                                       id="password" name="password">
                                <span class="input-group-text bg-secondary text-white border-light" onclick="togglePassword('password', 'togglePasswordIcon')">
                                    <i id="togglePasswordIcon" class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label fw-semibold text-dark">Confirmar Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-secondary text-white border-light" id="password_confirmation" name="password_confirmation">
                                <span class="input-group-text bg-secondary text-white border-light" onclick="togglePassword('password_confirmation', 'toggleConfirmPasswordIcon')">
                                    <i id="toggleConfirmPasswordIcon" class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg rounded-pill shadow-sm">
                                <i class="fas fa-save"></i> Actualizar
                            </button>
                            <a href="{{ route('usuario.index') }}" class="btn btn-outline-dark btn-lg rounded-pill shadow-sm">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId, iconId) {
        let field = document.getElementById(fieldId);
        let icon = document.getElementById(iconId);
        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            field.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection

