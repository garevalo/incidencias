<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Componente;
use App\User;
use App\Cliente;
use App\Incidencia;
use App\Estado;
use App\IncidenciaComponente;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Yajra\Datatables\Datatables;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role', ['only' => ['create']]);
    }

    public function index(Request $request)
    {
        if ($request->user()->idrol == 1) {
            return view("admin.incidencias.incidencias");
        } else {
            return view("admin.incidencias.incidencias-tecnico");
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['tecnicos'] = User::where('idrol', 2)->get();
        //print_r($data['tecnicos']);
        $data['componentes'] = Componente::all();
        $data['titulo'] = "Registrar Incidencia";
        return view("admin.incidencias.nuevo", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->all()); exit('stop');

        $datavalidate = array();
        $messages = [
            'digits_between' => 'El campo debe tener entre :min - :max dígitos'
        ];
        if (empty($request->idcliente)) {
            $datavalidate = array(
                'cliente' => 'required|min:4|max:40|string',
                'ruc_dni' => 'required|digits_between:8,11|numeric',
                'telefono' => 'required|digits_between:7,9|numeric|unique:clientes,telefono',
                'direccion' => 'required|min:4|max:40|string');
        }
        $datavalidate = array(
            'marca' => 'required|min:2|max:40|alpha_num',
            'modelo' => 'required|min:2|max:40|alpha_num',
            'serie' => 'required|min:2|max:40|alpha_num',
            'descripcion_servicio' => 'required|min:2|max:40|string',
            'tipo_equipo' => 'required|min:2|max:20|alpha',
            'condicion' => 'required|min:2|max:20|alpha',
            'componente' => 'required',
            'tecnico' => 'required|numeric',
            'prioridad' => 'required|digits_between:1,2|numeric');

        $validator = Validator::make($request->all(), $datavalidate, $messages);

        if ($validator->fails()) {
            return redirect('incidencia/create')->withErrors($validator)->withInput();
        } else {

            // DB::transaction(function () {
            if (empty($request->idcliente)) {
                $Cliente = new Cliente;
                $Cliente->nombre = $request->cliente;
                $Cliente->dni_ruc = $request->ruc_dni;
                $Cliente->telefono = $request->telefono;
                $Cliente->direccion = $request->direccion;
                $Cliente->save();
                $idcliente = $Cliente::select('idcliente')->orderBy('idcliente', 'desc')->take(1)->first();
                $idcliente = $idcliente->idcliente;
            } else {
                $idcliente = $request->idcliente;
            }

            if (!empty($idcliente)) {

                $Incidencia = new Incidencia;
                $Incidencia->idcliente = $idcliente;
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datavalidate = array();

        if ($request->estado==3) {
            $datavalidate = array('diagnostico' =>'required' );
            $datavalidate = array('descripcion' =>'required' );
        }


        $validator = Validator::make($request->all(), $datavalidate);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json($messages);
        }else{
            $Incidencia = Incidencia::find($id);
            $Incidencia->estado       = $request->estado;
            $Incidencia->diagnostico   = $request->diagnostico;
            $Incidencia->descripcion_tecnico    = $request->descripcion;
            if($request->estado==2){
                $Incidencia->fecha_curso   = date('Y-m-d');
            }
            elseif($request->estado==3){
                $Incidencia->fecha_completa   = date('Y-m-d');   
            }
            
            return response()->json($Incidencia->save());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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

    public function anyData()
    {
        //$datos = User::select([])->get();
        return Datatables::of(Incidencia::join('clientes', 'clientes.idcliente', '=', 'incidencia.idincidencia')
            ->join('users', 'users.id', '=', 'incidencia.idtecnico'))
            ->addColumn('check', function ($incidencia) {
                return '<label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl" id="' . $incidencia->idincidencia . '"></span></label>';
            })
            ->addColumn('idincidencia', function ($incidencia) {
                return '<a href="' . url('incidencia/edit' . $incidencia->idincidencia) . '">' . $incidencia->idincidencia . '</a>';
            })
            ->addColumn('tecnico', function ($incidencia) {
                return $incidencia->name . ' ' . $incidencia->apellido;
            })
            ->addColumn('estado', function ($incidencia) {
                if ($incidencia->estado == 1) {
                    $estado = '<span class="label label-info">Abierta</span>';
                } elseif ($incidencia->estado == 2) {
                    $estado = '<span class="label label-warning">En Curso</span>';
                } elseif ($incidencia->estado == 3) {
                    $estado = '<span class="label label-success">Cerrada</span>';
                }
                return $estado;
            })
            ->addColumn('prioridad', function ($incidencia) {
                if ($incidencia->prioridad == '1') {
                    $estado = '<span class="label label-info">Baja</span>';
                } elseif ($incidencia->prioridad == '2') {
                    $estado = '<span class="label label-warning">Media</span>';
                } elseif ($incidencia->prioridad == '3') {
                    $estado = '<span class="label label-danger">Alta</span>';
                }
                return $estado;
            })
            ->addColumn('edit', function ($incidencia) {
                return '<a ng-click="modalIncidencia(2,' . $incidencia->idincidencia . ')" class="green"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            })
            ->make(true);
    }

    public function incidenciasAsignadas()
    {
        //$datos = User::select([])->get();
        return Datatables::of(Incidencia::select(
            'incidencia.idincidencia',
            'incidencia.idcliente',
            'incidencia.marca',
            'incidencia.modelo',
            'incidencia.serie',
            'incidencia.prioridad',
            'incidencia.estado',
            'clientes.nombre')
            ->join('clientes', 'clientes.idcliente', '=', 'incidencia.idincidencia')
            ->join('users', 'users.id', '=', 'incidencia.idtecnico')
            ->where('users.id', Auth::user()->id)
            ->orderBy('prioridad', 'desc'))
            ->addColumn('check', function ($incidencia) {
                return '<label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl" id="' . $incidencia->idincidencia . '"></span></label>';
            })
            ->addColumn('idincidencia', function ($incidencia) {
                return '<a href="' . url('incidencia/edit' . $incidencia->idincidencia) . '">' . $incidencia->idincidencia . '</a>';
            })
            ->addColumn('tecnico', function ($incidencia) {
                return $incidencia->name . ' ' . $incidencia->apellido;
            })
            ->addColumn('estado', function ($incidencia) {
                if ($incidencia->estado == 1) {
                    $estado = '<span class="label label-info">Abierta</span>';
                } elseif ($incidencia->estado == 2) {
                    $estado = '<span class="label label-warning">En Curso</span>';
                } elseif ($incidencia->estado == 3) {
                    $estado = '<span class="label label-success">Cerrada</span>';
                }
                return $estado;
            })
            ->addColumn('prioridad', function ($incidencia) {
                if ($incidencia->prioridad == '1') {
                    $prioridad = '<span class="label label-info">Baja</span>';
                } elseif ($incidencia->prioridad == '2') {
                    $prioridad = '<span class="label label-warning">Media</span>';
                } elseif ($incidencia->prioridad == '3') {
                    $prioridad = '<span class="label label-danger">Alta</span>';
                }
                return $prioridad;
            })
            ->addColumn('edit', function ($incidencia) {
                return '<a ng-click="modalIncidencia(2,' . $incidencia->idincidencia . ')" class="green"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            })
            ->make(true);
    }

    public function modal($modal = 'new')
    {
        $data['estados'] = Estado::all();
        if ($modal == "new")
            return view('admin.incidencias.nuevo_cliente');
        else {
            return view('admin.incidencias.editar',$data);
        }
    }

    public function dataIncidencia($id = null)
    {
        if (empty($id))
            return response()->json(Incidencia::all());
        else
            return response()->json(Incidencia::join('clientes', 'clientes.idcliente', '=', 'incidencia.idincidencia')
                ->where('incidencia.idincidencia', $id)
                ->first());
    }
}
