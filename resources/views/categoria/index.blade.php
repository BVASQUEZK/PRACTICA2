@extends('plantilla.app')
@section('contenido')
<div class="app-content mt-3">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">Categorías</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive">
                    <div>
                        <form action="{{route('categorias.index')}}" method="get">
                            <div class="input-group">
                                <input name="texto" type="text" class="form-control" value="{{$texto}}" placeholder="Ingrese texto a buscar">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Buscar</button>
                                    <a href="{{route('categorias.create')}}" class="btn btn-primary"> Nuevo</a>                      
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mt-3">
                        @if(Session::has('mensaje'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{Session::get('mensaje')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{Session::get('error')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                    <div class="mt-3">
                        <table class="table table-bordered table-hover table-stripes">
                        <thead>
                            <tr>
                            <th>Opciones</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($registros)<=0)
                                <tr>
                                    <td colspan="3">No hay registros que coincidan con el texto consultado {{$texto}}.</td>
                                </tr>
                            @else
                                @foreach($registros as $reg)
                                <tr class="align-middle">
                                <td>
                                    <a href="{{route('categorias.edit',$reg->id)}}" class="btn btn-secondary btn-sm">&#9998;</a>
                                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-eliminar-{{$reg->id}}">&#128465;</button>
                                </td>
                                <td>{{$reg->id}}</td>
                                <td>{{$reg->nombre}}</td>
                                </tr> 
                                @include('categoria.delete')
                                @endforeach
                            @endif                     
                        </tbody>
                        </table>
                    </div>           
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix table-responsive">
                    {{$registros->appends(["texto" => $texto])}}
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
      document.getElementById("liAlmacen").classList.add("menu-open");
      document.getElementById("aCategoria").classList.add("active");
    </script>
@endpush