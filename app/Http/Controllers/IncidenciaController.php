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
use Symfony\Component\Console\Input\Input;
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
        if ($request->user()->idrol == 1 ||  $request->user()->idrol == 3) {
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
        $data['tecnicos'] = User::where('idrol', 2)->where('estado',1)->get();
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
                'ruc_dni' => 'required|dni_ruc|numeric',
                'telefono' => 'required|digits_between:7,9|numeric|unique:clientes,telefono',
                'direccion' => 'required|min:4|max:40|string',
                'marca' => 'required|min:2|max:40|alpha_num',
                'modelo' => 'required|min:2|max:40|alpha_num',
                'serie' => 'required|min:2|max:40|alpha_num',
                'descripcion_servicio' => 'required|min:2|max:40|string',
                'tipo_equipo' => 'required|min:2|max:20|alpha',
                'condicion' => 'required|min:2|max:20|alpha',
                'componente' => 'required',
                'tecnico' => 'required|numeric',
                'prioridad' => 'required|digits_between:1,2|numeric',
                'precioestimado' => 'required|numeric');
            } else{
            $datavalidate = array(
                'marca' => 'required|min:2|max:40|alpha_num',
                'modelo' => 'required|min:2|max:40|alpha_num',
                'serie' => 'required|min:2|max:40|alpha_num',
                'descripcion_servicio' => 'required|min:2|max:40|string',
                'tipo_equipo' => 'required|min:2|max:20|alpha',
                'condicion' => 'required|min:2|max:20|alpha',
                'componente' => 'required',
                'tecnico' => 'required|numeric',
                'prioridad' => 'required|digits_between:1,2|numeric',
                'precioestimado' => 'required|numeric');
            }

        $validator = Validator::make($request->all(), $datavalidate, $messages);

        if ($validator->fails()) { /*si hay errores devuelve a la vista*/
            return redirect('incidencia/create')->withErrors($validator)->withInput();
        } else { /*si no hay eerores crear el registro*/

            // DB::transaction(function () {
            if (empty($request->idcliente)) {/*si no existe un cliente lo registra*/
                $Cliente = new Cliente;
                $Cliente->nombre = $request->cliente;
                $Cliente->dni_ruc = $request->ruc_dni;
                $Cliente->telefono = $request->telefono;
                $Cliente->direccion = $request->direccion;
                $Cliente->estado_cliente = 1;
                $Cliente->save();
                $idcliente = $Cliente::select('idcliente')->orderBy('idcliente', 'desc')->take(1)->first();
                $idcliente = $idcliente->idcliente;
            } else {
                $idcliente = $request->idcliente; /*si ya existe retorna su id de cliente */
            }

            if (!empty($idcliente)) {
                /*requeste es la data que manda el formulario*/
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
                $Incidencia->precio_estimado = $request->precioestimado;
                $Incidencia->estado = 1;

                if ($Incidencia->save()) { /*aca hace el registro o insert */ 

                    $idincidencia = $Incidencia::select('idincidencia')->orderBy('idincidencia', 'desc')->take(1)->first();
                    foreach ($request->componente as $key => $componente) {
                        $IncidenciaComponente = new IncidenciaComponente;
                        $IncidenciaComponente->idcomponente = $componente;
                        $IncidenciaComponente->idincidencia = $idincidencia->idincidencia;
                        $IncidenciaComponente->serie_componente = $request->serie_componente[$componente];
                        $IncidenciaComponente->save(); /*aca regista a la base de datos los componentes del equipo*/
                    }
                }
            }

            // });

            return redirect('incidencia'); /*cunado termina de registrar te envia a la lista de registros*/

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
            $datavalidate = array('preciofinal' =>'required|numeric' );
        }


        $validator = Validator::make($request->all(), $datavalidate);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json($messages);
        }else{
            $Incidencia = Incidencia::find($id);
            $Incidencia->estado       = $request->estado;
            if($request->estado==2) {
             $Incidencia->diagnostico = $request->diagnostico;
             $Incidencia->fecha_curso   = date('Y-m-d H:i:s');
            }
            if ($request->estado==3) {
                $Incidencia->descripcion_tecnico = $request->descripcion;
                $Incidencia->fecha_completa   = date('Y-m-d H:i:s');
                $Incidencia->precio_final = $request->preciofinal; 
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
        return Datatables::of(Incidencia::select(DB::raw('incidencia.idincidencia, 
            incidencia.idcliente,
            incidencia.marca,
            incidencia.modelo,
            incidencia.serie,
            incidencia.prioridad,
            incidencia.estado,
            clientes.nombre,
            users.name,
            users.apellido,
            DATE_FORMAT(cast(incidencia.created_at as datetime),"%d-%m-%Y %H:%i:%s") fecha_creacion,
            DATE_FORMAT(incidencia.fecha_completa,"%d-%m-%Y %H:%i:%s") fecha_completa'))
            ->join('clientes', 'clientes.idcliente', '=', 'incidencia.idcliente')
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
                $estado = '';
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
                return '<a href="javascript:void(0)" ng-click="modalIncidencia(2,' . $incidencia->idincidencia . ')" class="green"><i class="glyphicon glyphicon-search"></i></a>';
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
            ->join('clientes', 'clientes.idcliente', '=', 'incidencia.idcliente')
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
            return response()->json(
                Incidencia::join('clientes', 'clientes.idcliente', '=', 'incidencia.idcliente')
                ->join('incidencia-componente','incidencia-componente.idincidencia','=','incidencia.idincidencia')
                ->join('componentes','incidencia-componente.idcomponente','=','componentes.idcomponente')
                ->where('incidencia.idincidencia', $id)
                ->get());
    }

    public function registrados(){
        $data['titulo'] = "Reporte de Atenciones Registradas";
        return view('admin.incidencias.reporte_registrado',$data);
    }

    public function procesarregistrado(Request $request){

        $fechaini =  $this->fecha($request->fechaini);
        $fechafin =  $this->fecha($request->fechafin);

        $data['incidencias'] = Incidencia::select(DB::raw('count(idincidencia) cantidad,concat(day(cast(created_at as DATE)),"/",month(cast(created_at as DATE))) dia'))
            ->groupBy(DB::raw('day(cast(created_at as DATE))'))
            ->whereBetween(DB::raw('date(cast(created_at as Date))'), [$fechaini, $fechafin])
            ->get();
        $data['tipo'] = 'Registrados';
        return view('admin.incidencias.reportes.procesar_registrados',$data);
    }

    public function atendidos(){
        $data['titulo'] = "Reporte de Atenciones Completas ";
        return view('admin.incidencias.reporte_atendido',$data);
    }

    public function procesaratendido(Request $request){

        $fechaini =  $this->fecha($request->fechaini);
        $fechafin =  $this->fecha($request->fechafin);

        $data['incidencias'] = Incidencia::select(DB::raw('count(idincidencia) cantidad,concat(day(fecha_completa),"/",month(fecha_completa)) dia'))
            ->groupBy(DB::raw('day(fecha_completa)'))
            ->whereBetween(DB::raw('date(fecha_completa)'), [$fechaini, $fechafin])
            ->where('incidencia.estado','3')
            ->get();
        $data['tipo'] = 'atendidos';
        return view('admin.incidencias.reportes.procesar_registrados',$data);
    }

    public function atendidosxtecnico(){
        $data['titulo'] = "Reporte de Atenciones por técnico";
        return view('admin.incidencias.reporte_atendido_tecnico',$data);
    }

    public function procesaratendidoxtecnico(Request $request){

        $fechaini =  $this->fecha($request->fechaini);
        $fechafin =  $this->fecha($request->fechafin);

        /* return Datatables::of(Incidencia::join('clientes', 'clientes.idcliente', '=', 'incidencia.idcliente')
            ->join('users', 'users.id', '=', 'incidencia.idtecnico'))*/

        $data['incidencias'] = Incidencia::select(DB::raw('count(idincidencia) cantidad,concat(users.name," ",users.apellido) as tecnico'))
            ->join('users', 'users.id', '=', 'incidencia.idtecnico')
            ->groupBy('incidencia.idtecnico')
            ->whereBetween(DB::raw('date(fecha_completa)'), [$fechaini, $fechafin])
            ->where('incidencia.estado','3')
            ->get();
        $data['tipo'] = 'atendidos por técnico';
        //print_r($data['incidencias']);
        return view('admin.incidencias.reportes.procesar_atendidos_tecnico',$data);
    }


    public function eficiencia(){
        $data['titulo'] = "Grado de cumplimiento";
        return view('admin.incidencias.reporte_eficiencia',$data);

    }

    public function procesareficiencia(Request $request){
        
        $fechaini =  $this->fecha($request->fechaini);
        $fechafin =  $this->fecha($request->fechafin);

        $data['incidencias'] = Incidencia::select(
                                                DB::raw('incidencia.idincidencia,DATE_FORMAT(cast(incidencia.created_at as DATE),"%d-%m-%Y") fecha_creacion, 
                                                        DATE_FORMAT(incidencia.fecha_completa,"%d-%m-%Y") fecha_completa')
                                                )
            ->join('clientes', 'clientes.idcliente', '=', 'incidencia.idcliente')
            ->join('users', 'users.id', '=', 'incidencia.idtecnico')
            ->whereBetween(DB::raw('cast(incidencia.created_at as DATE)'), [$fechaini, $fechafin])
            ->get();

        $data['cantidade'] = $request->registroe;   
        $data['costoe'] = $request->costoe;
        $data['tiempoe'] = $request->tiempoe;

        return view('admin.incidencias.reportes.procesar_eficiencia',$data);    
    }



    public function eficacia(){
        $data['titulo'] = "Reporte Indicador eficacia";
        return view('admin.incidencias.reporte_eficacia',$data);

    }

    public function procesareficacia(Request $request){
        
        $fechaini =  $this->fecha($request->fechaini);
        $fechafin =  $this->fecha($request->fechafin);

        $data['incidencias'] = Incidencia::select(DB::raw(' incidencia.idincidencia,
                                                           count(incidencia.idincidencia) cantidad,
                                                            DATE_FORMAT(cast(incidencia.created_at as DATE),"%d-%m-%Y") fecha'))
            ->join('clientes', 'clientes.idcliente', '=', 'incidencia.idcliente')
            ->groupBy(DB::raw('day(cast(incidencia.created_at as DATE))'))
            ->whereBetween(DB::raw('cast(incidencia.created_at as DATE)'), [$fechaini, $fechafin])
            //->where('incidencia.estado','1')
            ->get();

        $data['cantidade'] = $request->registroe;   

        return view('admin.incidencias.reportes.procesar_eficacia',$data);    
    }

    public function reportetecnico(){
        $data['titulo'] = "Reporte detallado por técnico";
        return view('admin.incidencias.reporte_tecnico',$data);

    }

    public function procesartecnico(Request $request){
        
        $fechaini =  $this->fecha($request->fechaini);
        $fechafin =  $this->fecha($request->fechafin);

        $idtecnico =  $this->fecha($request->fechafin);

        $data['incidencias'] = Incidencia::select(DB::raw('count(incidencia.idincidencia) cantidad,sum(incidencia.precio_final) precio,((TIMESTAMPDIFF(SECOND,date(cast(incidencia.created_at as Date)),incidencia.fecha_completa ))/3600)horas,DATE_FORMAT(incidencia.fecha_completa,"%d-%m-%Y") fecha'))
            ->join('clientes', 'clientes.idcliente', '=', 'incidencia.idcliente')
            ->join('users', 'users.id', '=', 'incidencia.idtecnico')
            ->groupBy(DB::raw('day(fecha_completa)'))
            ->whereBetween(DB::raw('date(fecha_completa)'), [$fechaini, $fechafin])
            ->where('incidencia.estado','3')
            ->get();

        $data['cantidade'] = $request->registroe;   

        return view('admin.incidencias.reportes.procesar_tecnico',$data);    
    }



    private function fecha($string){
        $fecha_array =  explode('/',$string);
        return $fecha_array[2].'-'.$fecha_array[1].'-'.$fecha_array[0];
    }



}
