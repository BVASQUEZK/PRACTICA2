@extends('plantilla.app')
@section('contenido')
<div class="app-content mt-3">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header"><h3 class="card-title">Usuarios</h3></div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <div>
                            <form action="{{ route('usuario.index') }}" method="get">
                                <div class="input-group">
                                    <input name="texto" type="text" class="form-control" value="{{ $texto }}" placeholder="Ingrese texto a buscar">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Buscar</button>
                                        <a href="{{ route('usuario.create') }}" class="btn btn-primary"> Nuevo</a>                      
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mt-3">
                            @if(Session::has('mensaje'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ Session::get('mensaje') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if(Session::has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($registros) <= 0)
                                    <tr>
                                        <td colspan="4">No hay registros que coincidan con el texto consultado "{{ $texto }}".</td>
                                    </tr>
                                    @else
                                    @foreach($registros as $reg)
                                    <tr class="align-middle">
                                        <td>
                                            <a href="{{ route('usuario.edit', $reg->id) }}" class="btn btn-secondary btn-sm">&#9998;</a>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-eliminar-{{ $reg->id }}">&#128465;</button>
                                        </td>
                                        <td>{{ $reg->id }}</td>
                                        <td>{{ $reg->name }}</td>
                                        <td>{{ $reg->email }}</td>
                                    </tr> 
                                    <!-- Modal de eliminación -->
                                    <div class="modal fade" id="modal-eliminar-{{ $reg->id }}" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Eliminar Usuario</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar al usuario <strong>{{ $reg->name }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('usuario.destroy', $reg->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif                     
                                </tbody>
                            </table>
                        </div>           
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix table-responsive">
                        {{ $registros->appends(["texto" => $texto]) }}
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@endsection

@push('scripts')
    <script>
        document.getElementById("liUsuarios").classList.add("menu-open");
        document.getElementById("aUsuario").classList.add("active");
    </script>
@endpush
