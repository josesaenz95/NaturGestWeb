@extends('templates/master')
@section('title', 'Gestion Trabajadores')

@section('content')
<div class="row mt-5 pb-5">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card" id="ver-trabajadores">
            <div class="card-header bg-form text-white">
                <h3 class="text-center">Ver Trabajadores</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 buscar-trabajadores">
                        <div class="form-row">
                            <a data-scroll href="#form-registro" class="btn text-white btn-todown" id="btnToDown" type="button">Ir a Registrar</a>
                            <div class="form-group col-lg-2">
                                <label for="">Filtrar Por:</label>
                                <select class="form-control" id="slFiltro" name="slFiltro" placeholder="Filtrar Por:">
                                    <option value="id">ID</option>
                                    <option value="rut">Rut</option>
                                    <option value="nombre">Nombre</option>
                                    <option value="ap_pat">Apellido Paterno</option>
                                    <option value="sucursal">Sucursal</option>
                                    <option value="usuario">Tipo Usuario</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="">Ingrese Búsqueda</label>
                                <input class="form-control" type="text" id="txtBuscarTrabajador" name="txtBuscarTrabajador">
                            </div>
                            <button class="btn" type="button" id="btnBuscarTrabajador"><img class="ico-buscar" src="img/buscar.png" alt="Ícono Buscar"></button>
                        </div>
                    </div>
                </div>
                <table class="table table-hover table-trabajadores">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Rut</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ap. Paterno</th>
                        <th scope="col">Ap. Materno</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col">Tipo Usuario</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="tbody-trabajadores">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
<div class="row pb-5">
    <div class="col-lg-8 col-md-8 col-sm-8 mx-auto">
        <div id="errores">

        </div>
        <div class="card">
            <div class="card-header bg-form text-white">
                <h3 class="text-center">INGRESAR TRABAJADOR</h3>
            </div>
            <div class="card-body" id="form-registro">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="txtRut">R.U.T</label>
                        <input class="form-control" type="text" name="txtRut" id="txtRut">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="txtNombre">Nombre</label>
                        <input class="form-control" type="text" name="txtNombre" id="txtNombre">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="txtApPat">Apellido Paterno</label>
                        <input class="form-control" type="text" name="txtApPat" id="txtApPat">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="txtApMat">Apellido Materno</label>
                        <input class="form-control" type="text" name="txtApMat" id="txtApMat">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="txtDir">Dirección</label>
                        <input class="form-control" type="text" name="txtDir" id="txtDir">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="txtNDir">N° Dirección</label>
                        <input class="form-control" type="number" name="txtNDir" id="txtNDir" min="0">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="txtFono">Teléfono</label>
                        <input class="form-control" type="number" name="txtFono" id="txtFono">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="txtCorreo">Correo Electrónico</label>
                        <input class="form-control" type="email" name="txtCorreo" id="txtCorreo" min="0">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="slSucursal">Sucursal</label>
                        <select class="form-control" name="slSucursales" id="slSucursales">
                            <option value="0">Seleccione...</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="slUsuario">Tipo Usuario</label>
                        <select class="form-control" name="slUsuario" id="slUsuario">
                            <option value="0">Seleccione...</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-lg btn-block bg-form text-white" id="btnRegistrar">Registrar Trabajador</button>
                <a class="btn btn-lg btn-block bg-form text-white" id="btnEd" hidden>Editar Trabajador</a>
                {{-- <a data-scroll href="#ver-trabajadores" class="btn text-white btn-toup" id="btnToUp" type="button">Ir a Registrar</a> --}}
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('script')
    <script src="{{asset('js/trabajadores.js')}}"></script>
@endsection