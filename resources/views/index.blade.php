@extends('templates/master')
@switch(auth()->user()->name)
    @case('operador')
        @section('title', 'Home Operador')        
        @break
    @case('administrador')
        @section('title', 'Home Administrador')        
        @break
    @case('gerente')
        @section('title', 'Home Gerente')        
        @break
    @default
        @break
@endswitch


@section('content')

    <div class="row mt-5">
            @switch(auth()->user()->name)
            @case('operador')
            <div class="col-lg-6 col-md-6 col-sm-6 mt-5">
                <div class="row pb-5">
                    <div class="col-lg-12 col-md12 col-sm-12">
                        <a class="btn btn-lg btn-block text-white btn-section" href="#">VENTAS</a>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <a class="btn btn-lg btn-block text-white mt-5 btn-section" href="#">INVENTARIO</a>
                    </div>
                </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h1 class="text-center">TURNOS</h1>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Rut</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Día</th>
                            <th scope="col">Hora Inicio</th>
                            <th scope="col">Hora Término</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1234-5</td>
                            <td>Giorgio</td>
                            <td>19-05-2019</td>
                            <td>08:30</td>
                            <td>13:30</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @break
            @case('administrador')
            <div class="col-lg-6 col-md-6 col-sm-6 mt-5">
                    <a class="btn btn-lg btn-block text-white btn-section" href="#">VENTAS</a>
                    <a class="btn btn-lg btn-block text-white mt-5 btn-section" href="{{route('proveedores')}}">GESTIÓN PROVEEDORES</a>
                    <a class="btn btn-lg btn-block text-white mt-5 btn-section" href="#">GESTIÓN PRODUCTOS</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h1 class="text-center">TURNOS</h1>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Rut</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Día</th>
                            <th scope="col">Hora Inicio</th>
                            <th scope="col">Hora Término</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1234-5</td>
                            <td>Giorgio</td>
                            <td>19-05-2019</td>
                            <td>08:30</td>
                            <td>13:30</td>
                        </tr>
                        </tbody>
                    </table>
                </div> 
                @break
            @case('gerente')
            <div class="col-lg-6 col-md-6 col-sm-6 mt-5 pb-5">
                <a class="btn btn-lg btn-block text-white btn-section" href="{{route('proveedores')}}">GESTIÓN PROVEEDORES</a>
                <a class="btn btn-lg btn-block text-white mt-5 btn-section" href="#">GESTIÓN PRODUCTOS</a>
                <a class="btn btn-lg btn-block text-white mt-5 btn-section" href="#">GESTIÓN COMPRAS</a>
            </div>
            <div class="col-lg col-md col-sm mt-5">
                <div class="card mt-1">
                <div class="card-header">
                  Llegada de nuevo stock
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>Hoy a las 15:30 llegara el caminion con el nuevo stock para bodega</p>
                    <footer class="blockquote-footer">Gerencia: <cite title="Source Title">Sammy Angulo</cite></footer>
                  </blockquote>
                </div>
              </div>
              <div class="card mt-1">
              <div class="card-header">
                Ingreso de stock al sistema
              </div>
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <p>Hoy a las 18:55 Ingreso al Sistema NaturGest</p>
                  <footer class="blockquote-footer">Gerencia: <cite title="Source Title">Juan Ruiz</cite></footer>
                </blockquote>
              </div>
            </div>
                @break
            @default
                @break
        @endswitch
    </div>

@endsection