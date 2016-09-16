<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Componente;
use App\User;
use App\Cliente;
use App\Incidencia;
use App\IncidenciaComponente;
use DB;
use Validator;
use Yajra\Datatables\Datatables;

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
            'cliente'    => 'required|min:4|max:40|string',
            'ruc_dni'    => 'required|digits_between:8,11|numeric',
            'telefono'   => 'required|digits_between:7,9|numeric|unique:clientes,telefono',
            'direccion'  => 'required|min:4|max:40|string',
            'marca'      => 'required|min:2|max:40|alpha_num',
            'modelo'      => 'required|min:2|max:40|alpha_num',
            'serie'       => 'required|min:2|max:40|alpha_num',
            'descripcion_servicio'       => 'required|min:2|max:40|string',
            'tipo_equipo'       => 'required|min:2|max:20|alpha',
            'condicion'       => 'required|min:2|max:20|alpha',
            'componente'      => 'required',
            'tecnico'       => 'required|numeric',
            'prioridad'       => 'required|min:2|max:20|alpha',
        ],$messages);

        if ($validator->fails()) {
            return redirect('incidencia/create')->withErrors($validator)->withInput();
        }else{

            // DB::transaction(function () {
                $Cliente = new Cliente;
                $Cliente->nombre     = $request->cliente;
                $Cliente->dni_ruc     = $request->ruc_dni;
                $Cliente->telefono    = $request->telefono;
                $Cliente->direccion   = $request->direccion;

                if ($Cliente->save()) {

                    $idcliente = $Cliente::select('idcliente')->orderBy('idcliente', 'desc')->take(1)->first();

                    $Incidencia = new Incidencia;
                    $Incidencia->idcliente = $idcliente->idcliente;
                    $Incidencia->marca = $request->marca;
                    $Incidencia->modelo = $request->modelo;
                    $Incidencia->serie = $request->serie;
                    $Incidencia->descripcion = $request->descripcion_servicio;
                    $Incidencia->tipo = $request->tipo_equipo;
                    $Incidencia->condicion = $request->condicion;
                    $Incidencia->prioridad = $request->prioridad;
                    $Incidencia->idtecnico = $request->tecnico;
                    $Incidencia->estado = 1;

                    if ($Incidencia->save()) {

                        $idincidencia = $Incidencia::select('idincidencia')->orderBy('idincidencia', 'desc')->take(1)->first();
                        foreach ($request->componente as $key => $componente) {
                            $IncidenciaComponente = new IncidenciaComponente;
                            $IncidenciaComponente->idcomponente = $componente;
                            $IncidenciaComponente->idincidencia = $idincidencia->idincidencia;
                            $IncidenciaComponente->serie = $request->serie_componente[$componente];
                            $IncidenciaComponente->save();
                        }
                    }

                }

           // });

            return redirect('incidencia');

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
        /*
         * $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();*/
    }

    public function anyData(){
        //$datos = User::select([])->get();
        return Datatables::of(Incidencia::join('clientes','clientes.idcliente','=','incidencia.idincidencia')
                                        ->join('users','users.id','=','incidencia.idtecnico'))
            ->addColumn('check',function($incidencia){
                return '<label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl" id="'.$incidencia->idincidencia.'"></span></label>';
            })
            ->addColumn('tecnico',function($incidencia){
                return $incidencia->name.' '.$incidencia->apellido;
            })
            ->addColumn('estado',function($incidencia){
                if($incidencia->estado==1){
                    $estado = '<span class="label label-info">Solicitado</span>';
                }elseif($incidencia->estado==2){
                    $estado = '<span class="label label-warning">En Curso</span>';
                }
                elseif($incidencia->estado==2){
                    $estado = '<span class="label label-success">Completado</span>';
                }
                return $estado;
            })
            ->addColumn('edit',function($incidencia){
                return '<a ng-click="modalIncidencia(2,'.$incidencia->idincidencia.')" class="green"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            })
            ->make(true);
    }
}
