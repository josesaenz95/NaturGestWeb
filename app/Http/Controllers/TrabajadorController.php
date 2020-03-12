<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabajador;
use App\Sucursal;
use App\User;

class TrabajadorController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Trabajador::select('trabajadores.id', 'trabajadores.rut', 'trabajadores.nombre',
                                  'trabajadores.ap_pat', 'trabajadores.ap_mat', 'trabajadores.telefono',
                                  'trabajadores.direccion', 'trabajadores.n_direccion',
                                  'trabajadores.correo', 's.nombre as sucursal' , 'users.name as usuario')
                         ->join('sucursales as s', 's.id', '=', 'trabajadores.sucursales_id')
                         ->join('users', 'users.id', '=', 'trabajadores.users_id')
                         ->whereNotIn('users.name', array("gerente"))
                         ->orderBy('trabajadores.id', 'asc')
                         ->get();
    }

    public function getSucursales()
    {
        return Sucursal::get();
    }

    public function getUsuarios()
    {
        return User::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            Trabajador::create($data);
        }catch(Exception $ex){
            return $ex->json();
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
        try{
            if(strpos($request, 'id')){
                $id = str_replace('_id', '', $request);
                return Trabajador::select('trabajadores.id', 'trabajadores.rut', 'trabajadores.nombre',
                                  'trabajadores.ap_pat', 'trabajadores.ap_mat', 'trabajadores.telefono',
                                  'trabajadores.direccion', 'trabajadores.n_direccion',
                                  'trabajadores.correo', 's.nombre as sucursal' , 'users.name as usuario')
                         ->join('sucursales as s', 's.id', '=', 'trabajadores.sucursales_id')
                         ->join('users', 'users.id', '=', 'trabajadores.users_id')
                         ->whereNotIn('users.name', array("gerente"))
                         ->where('trabajadores.id', $id)
                         ->get();
            }else if(strpos($request, 'rut')){
                $rut = str_replace('_rut', '', $request);
                return Trabajador::select('trabajadores.id', 'trabajadores.rut', 'trabajadores.nombre',
                                          'trabajadores.ap_pat', 'trabajadores.ap_mat', 'trabajadores.telefono',
                                          'trabajadores.direccion', 'trabajadores.n_direccion',
                                          'trabajadores.correo', 's.nombre as sucursal' , 'users.name as usuario')
                                 ->join('sucursales as s', 's.id', '=', 'trabajadores.sucursales_id')
                                 ->join('users', 'users.id', '=', 'trabajadores.users_id')
                                 ->whereNotIn('users.name', array("gerente"))
                                 ->where('rut', 'like', "{$rut}%")
                                 ->orderBy('trabajadores.id', 'asc')
                                 ->get();
            }else if(strpos($request, 'nombre')){
                $nombre = str_replace('_nombre', '', $request);
                return Trabajador::select('trabajadores.id', 'trabajadores.rut', 'trabajadores.nombre',
                                          'trabajadores.ap_pat', 'trabajadores.ap_mat', 'trabajadores.telefono',
                                          'trabajadores.direccion', 'trabajadores.n_direccion',
                                          'trabajadores.correo', 's.nombre as sucursal' , 'users.name as usuario')
                                 ->join('sucursales as s', 's.id', '=', 'trabajadores.sucursales_id')
                                 ->join('users', 'users.id', '=', 'trabajadores.users_id')
                                 ->whereNotIn('users.name', array("gerente"))
                                 ->where('trabajadores.nombre', 'like', "{$nombre}%")
                                 ->orderBy('trabajadores.id', 'asc')
                                 ->get();
            }else if(strpos($request, 'ap_pat')){
                $ap_pat = str_replace('_ap_pat', '', $request);
                return Trabajador::select('trabajadores.id', 'trabajadores.rut', 'trabajadores.nombre',
                                          'trabajadores.ap_pat', 'trabajadores.ap_mat', 'trabajadores.telefono',
                                          'trabajadores.direccion', 'trabajadores.n_direccion',
                                          'trabajadores.correo', 's.nombre as sucursal' , 'users.name as usuario')
                                 ->join('sucursales as s', 's.id', '=', 'trabajadores.sucursales_id')
                                 ->join('users', 'users.id', '=', 'trabajadores.users_id')
                                 ->whereNotIn('users.name', array("gerente"))
                                 ->where('ap_pat', 'like', "{$ap_pat}%")
                                 ->orderBy('trabajadores.id', 'asc')
                                 ->get();
            }else if(strpos($request, 'sucursal')){
                $sucursal = str_replace('_sucursal', '', $request);
                return Trabajador::select('trabajadores.id', 'trabajadores.rut', 'trabajadores.nombre',
                                          'trabajadores.ap_pat', 'trabajadores.ap_mat', 'trabajadores.telefono',
                                          'trabajadores.direccion', 'trabajadores.n_direccion',
                                          'trabajadores.correo', 's.nombre as sucursal' , 'users.name as usuario')
                                 ->join('sucursales as s', 's.id', '=', 'trabajadores.sucursales_id')
                                 ->join('users', 'users.id', '=', 'trabajadores.users_id')
                                 ->whereNotIn('users.name', array("gerente"))
                                 ->where('s.nombre', 'like', "{$sucursal}%")
                                 ->orderBy('trabajadores.id', 'asc')
                                 ->get();
            }else if(strpos($request, 'usuario')){
                $usuario = str_replace('_usuario', '', $request);
                return Trabajador::select('trabajadores.id', 'trabajadores.rut', 'trabajadores.nombre',
                                          'trabajadores.ap_pat', 'trabajadores.ap_mat', 'trabajadores.telefono',
                                          'trabajadores.direccion', 'trabajadores.n_direccion',
                                          'trabajadores.correo', 's.nombre as sucursal' , 'users.name as usuario')
                                 ->join('sucursales as s', 's.id', '=', 'trabajadores.sucursales_id')
                                 ->join('users', 'users.id', '=', 'trabajadores.users_id')
                                 ->whereNotIn('users.name', array("gerente"))
                                 ->where('users.name', 'like', "{$usuario}%")
                                 ->orderBy('trabajadores.id', 'asc')
                                 ->get();
            }                 
        }catch(Exception $ex){
            return $ex->json();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $trabajador = Trabajador::findOrFail($id);
            $data = $request->all();
            $trabajador->update($data);
        } catch (Exception $ex) {
            return $ex->json();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Trabajador::destroy($id);
        } catch (Exception $ex) {
            return $ex->json();
        }
    }
}
