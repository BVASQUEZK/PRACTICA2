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
                  <div class="card-body">
                    <form action="{{route('categorias.store')}}" method="POST">
                        @csrf
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingrese nombre" required>
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>                          
                        </div>
                        <div class="col-lg-12 mt-2">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-secondary" type="reset">Cancelar</button>
                                
                            </div>
                        </div>
                        
                    </form>
                           
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <a href="{{route('categorias.index')}}">Regresar</a>
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