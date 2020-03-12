@extends('templates/master')
@section('title', 'Gestión Clientes')        

@section('content')
    <div class="row mt-5 pb-5">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <div id="errores">

            </div>
            <div class="card">
                <div class="card-header bg-form text-white">
                    <h3 class="text-center">INGRESAR CLIENTE</h3>
                </div>
                <div class="card-body">
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
                    <button class="btn btn-lg btn-block bg-form text-white" type="button" id="btnRegistrar">Registrar Cliente</button>
                    <button class="btn btn-lg btn-block bg-form text-white" type="button" id="btnEd" hidden>Editar Cliente</button>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7">
            <div class="card">
                <div class="card-header bg-form text-white">
                    <h3 class="text-center">Ver Clientes</h3>
                </div>
                <div class="card-body">
                    <div class="row mx-auto">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="form-group col-lg-2">
                                    <label for="">Filtrar Por:</label>
                                    <select class="form-control" id="slFiltro" name="slFiltro" placeholder="Filtrar Por:">
                                        <option value="id">ID</option>
                                        <option value="rut">Rut</option>
                                        <option value="nombre">Nombre</option>
                                        <option value="ap_pat">Apellido Paterno</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="">Ingrese Búsqueda</label>
                                    <input class="form-control" type="text" id="txtBuscarCliente" name="txtBuscarCliente">
                                </div>
                                <button class="btn" type="button" id="btnBuscarCliente"><img class="ico-buscar" src="img/buscar.png" alt="Ícono Buscar"></button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-clientes">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Rut</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody id="tbody-clientes">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{asset('js/clientes.js')}}"></script>
@endsection