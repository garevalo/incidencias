<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Componente;
use App\User;
use Validator;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view("admin.incidencias.incidencias");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['tecnicos']     = User::where('idrol', 2)->get();
        //print_r($data['tecnicos']);
        $data['componentes']  = Componente::all();
        $data['titulo']       = "Registrar Incidencia";
        return view("admin.incidencias.nuevo",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'digits_between' => 'El campo debe tener entre :min - :max dígitos'
        ];

        $validator = Validator::make($request->all(), [
            'cliente'    => 'required|min:4|max:40|alpha',
            'ruc_dni'    => 'required|digits_between:8,11|numeric',
            'telefono'   => 'required|digits_between:7,9|numeric|unique:clientes,telefono',
            'direccion'  => 'required|min:4|max:40|alpha_num',
            'marca'      => 'required|min:2|max:40|alpha_num',
            'modelo'      => 'required|min:2|max:40|alpha_num',
            'serie'       => 'required|min:2|max:40|alpha_num',
            'descripcion_servicio'       => 'required|min:2|max:40|alpha_num',
            'tipo-equipo'       => 'required|min:2|max:20|alpha',
            'condicion'       => 'required|min:2|max:20|alpha',
            'componente'      => 'required',
            'tecnico'       => 'required|numeric',
            'prioridad'       => 'required|min:2|max:20|alpha',
        ],$messages);

        if ($validator->fails()) {
            return redirect('incidencia/create')
                            ->withErrors($validator)
                            ->withInput();
        }else{
            print_r($request->all());
            print_r($request->componente);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
