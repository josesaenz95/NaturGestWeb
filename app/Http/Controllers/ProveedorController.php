<?php

namespace App\Http\Controllers;

use App\Proveedor;
use App\DirProveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Proveedor::select('proveedores.id', 'proveedores.rut', 'proveedores.nombre', 'd.direccion', 'd.n_dir', 
                                 'proveedores.telefono', 'proveedores.correo', 'd.ciudad')
                        ->join('dir_proveedores as d', 'd.proveedores_id', '=', 'proveedores.id')
                        ->orderBy('proveedores.id', 'asc')
                        ->get();
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
        try {        
            $proveedor = Proveedor::create([
                 'rut' => $request->rut,
                 'nombre' => $request->nombre,
                 'telefono' => $request->telefono,
                 'correo' => $request->correo
            ]);
            $proveedor->save();

            DirProveedor::create([
                'direccion' => $request->direccion,
                'n_dir' => $request->n_dir,
                'ciudad' => $request->ciudad,
                'proveedores_id' => $proveedor->id
            ]);
        } catch (Exception $ex) {
            return $ex->json();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
        try{
            if(strpos($request, 'id')){
                $id = str_replace('_id', '', $request);
                // return Proveedor::findOrFail($id);
                return Proveedor::select('proveedores.id', 'proveedores.rut', 'proveedores.nombre', 'd.direccion', 'd.n_dir', 
                                         'proveedores.telefono', 'proveedores.correo', 'd.ciudad')
                        ->join('dir_proveedores as d', 'd.proveedores_id', '=', 'proveedores.id')
                        ->where('proveedores.id', $id)
                        ->get();
            }else if(strpos($request, 'rut')){
                $rut = str_replace('_rut', '', $request);
                return Proveedor::select('proveedores.id', 'proveedores.rut', 'proveedores.nombre', 'd.direccion', 'd.n_dir', 
                                         'proveedores.telefono', 'proveedores.correo', 'd.ciudad')
                                ->join('dir_proveedores as d', 'd.proveedores_id', '=', 'proveedores.id')
                                ->where('rut', 'like', "{$rut}%")
                                ->orderBy('proveedores.id', 'asc')
                                ->get();
            }else if(strpos($request, 'nombre')){
                $nombre = str_replace('_nombre', '', $request);
                return Proveedor::select('proveedores.id', 'proveedores.rut', 'proveedores.nombre', 'd.direccion', 'd.n_dir', 
                                        'proveedores.telefono', 'proveedores.correo', 'd.ciudad')
                                ->join('dir_proveedores as d', 'd.proveedores_id', '=', 'proveedores.id')
                                ->where('nombre', 'like', "{$nombre}%")
                                ->orderBy('proveedores.id', 'asc')
                                ->get();
            }else if(strpos($request, 'ciudad')){
                $ciudad = str_replace('_ciudad', '', $request);
                return Proveedor::select('proveedores.id', 'proveedores.rut', 'proveedores.nombre', 'd.direccion', 'd.n_dir', 
                                         'proveedores.telefono', 'proveedores.correo', 'd.ciudad')
                                ->join('dir_proveedores as d', 'd.proveedores_id', '=', 'proveedores.id')
                                ->where('ciudad', 'like', "{$ciudad}%")
                                ->orderBy('proveedores.id', 'asc')
                                ->get();
            }           
        }catch(Exception $ex){
            return $ex->json();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $proveedor = Proveedor::findOrFail($id);
            $data = $request->all();
            
            // $proveedor->update($data)
            //           ->join('dir_proveedores as d', 'd.proveedores_id', '=', $proveedor)
            //           ->where('d.proveedores_id', $proveedor);

            $proveedor->update([
               'rut' => $request->rut,
               'nombre' => $request->nombre,
               'telefono' => $request->telefono,
               'correo' => $request->correo
             ]);
            //  $proveedor->save();
             DirProveedor::where('proveedores_id', $id)
                         ->update([
                            'direccion' => $request->direccion,
                            'n_dir' => $request->n_dir,
                            'ciudad' => $request->ciudad,
                         ]);

        }catch(Exception $ex){
            return $ex->json();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DirProveedor::where('proveedores_id', $id)->delete();
            Proveedor::destroy($id);
        }catch(Exception $ex){
            return $ex->json();
        }
    }
}
