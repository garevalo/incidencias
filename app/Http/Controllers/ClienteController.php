<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Rol;
use Validator;
use Yajra\Datatables\Datatables;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['titulo'] = "Lista de Clientes";
        return view("admin.clientes.clientes",$data);
    }

    public function modal($modal='new'){
        if($modal=="new")
            return view('admin.clientes.nuevo_cliente');
        else{
            return view('admin.clientes.edit_cliente');
        }
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
        $validator = Validator::make($request->all(), [
            'nombre'    => 'required|min:4|max:40|string',
            'rucdni'  => 'required|digits_between:8,11|numeric',
            'correo'    => 'required|email|unique:clientes',
            'telefono'   => 'required|digits_between:7,9|numeric|unique:clientes,telefono',
            'direccion'  => 'required|min:4|max:60|string'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json($messages);
        }else{

            $Cliente = new Cliente;
            $Cliente->nombre    = $request->nombre;
            $Cliente->dni_ruc   = $request->rucdni;
            $Cliente->correo    = $request->correo;
            $Cliente->telefono   = $request->telefono;
            $Cliente->direccion   = $request->direccion;

            return response()->json($Cliente->save());
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
        $validator = Validator::make($request->all(), [
            'nombre'    => 'required|min:4|max:40|string',
            'dni_ruc'  => 'required|digits_between:8,11|numeric',
            'correo'    => 'required|email',
            'telefono'   => 'required|digits_between:7,9|numeric',
            'direccion'  => 'required|min:4|max:60|string'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json($messages);
        }else{
            $Cliente = Cliente::find($id);
            $Cliente->nombre    = $request->nombre;
            $Cliente->dni_ruc   = $request->dni_ruc;
            $Cliente->correo    = $request->correo;
            $Cliente->telefono   = $request->telefono;
            $Cliente->direccion   = $request->direccion;
            return response()->json($Cliente->save());
        }
    }

    public function anyDataCliente(){
        //$datos = User::select([])->get();
        return Datatables::of(Cliente::all())
            ->addColumn('check',function($cliente){
                return '<label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl" id="'.$cliente->idcliente.'"></span></label>';
            })
            ->addColumn('edit',function($cliente){
                return '<a ng-click="modalCliente(2,'.$cliente->idcliente.')" class="green"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
            })
            ->make(true);
    }

    public function dataCliente($id=null){
        if(empty($id))
            return response()->json(Cliente::all());
        else
            return response()->json(Cliente::where('idcliente', $id)->first());
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
