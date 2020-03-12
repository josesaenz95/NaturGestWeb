<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
        
        return Cliente::get();
        
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
        $data = $request->all();
        //Cliente::insert($data);        
        Cliente::create($data);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
        try{
            if(strpos($request, 'id')){
                $id = str_replace('_id', '', $request);
                return Cliente::findOrFail($id);
            }else if(strpos($request, 'rut')){
                $rut = str_replace('_rut', '', $request);
                return Cliente::where('rut', 'like', "{$rut}%")->get();
            }else if(strpos($request, 'nombre')){
                $nombre = str_replace('_nombre', '', $request);
                return Cliente::where('nombre', 'like', "{$nombre}%")->get();
            }else if(strpos($request, 'ap_pat')){
                $ap_pat = str_replace('_ap_pat', '', $request);
                return Cliente::where('ap_pat', 'like', "{$ap_pat}%")->get();
            }           
        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                 'message' => 'Error al traer datos del servidor',
             ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $cliente = Cliente::findOrFail($id);
            $data = $request->all();
            $cliente->update($data);
            
        }catch(Exception $ex){
            return response()->json(['message' => 'Error al enviar datos al servidor']);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Cliente::destroy($id);
        }catch(Exception $ex){
            return $ex->json();
        }
        
    }
}
