<?php

namespace App\Http\Controllers;

use Storage;    
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Rol;
use Validator;
use Yajra\Datatables\Datatables;

class UsuarioController extends Controller
{

    public function index()
    {
      $data['titulo'] = "Lista de Usuarios";  
      return view("admin.usuarios.usuarios",$data);
    }

    public function perfil(){

      $data['titulo'] = "Perfil de Usuario";  
      return view("admin.usuarios.perfil",$data);
    }


    public function modal($modal='new',$iduser=null){
        $data['roles'] = Rol::all();

        if($modal=="new")
            return view('admin.usuarios.nuevo_usuario',$data);
        else{
          $data['user'] = User::find($iduser);
          $data['idrol'] = $data['user']->idrol;
          return view('admin.usuarios.edit_usuario',$data);    
        }
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'apellido'  => 'required|min:4|max:40|string',
            'correo'    => 'required|email|unique:users,email',
            'usuario'   => 'required|min:4|max:40|alpha_num|unique:users,usuario',
            'password'  => 'required|min:6|max:40|alpha_num',
            'rol'       => 'required|min:1|max:2|numeric',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json($messages);
        }else{

            $User = new User;

            $User->name     = $request->nombre;
            $User->apellido = $request->apellido;
            $User->email    = $request->correo;
            $User->usuario  = $request->usuario;
            $User->password = bcrypt($request->password);
            $User->idrol    = $request->rol;

            return response()->json($User->save());
        }  
        
    }


    public function editprofile(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'nombre'    => 'required|min:4|max:40|string',
            'apellido'  => 'required|min:4|max:40|string',
            'correo'    => 'required|email|unique:users,email,'.$request->user()->id,
            'usuario'   => 'required|min:4|max:40|alpha_num',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json($messages);
        }else{

            $User = User::find($request->user()->id);

            $User->name     = $request->nombre;
            $User->apellido = $request->apellido;
            $User->email    = $request->correo;
            $User->usuario  = $request->usuario;
            return response()->json($User->save());
        }    
        
    }



    public function editimage(Request $request){

        $validator = Validator::make($request->all(), [
            'file-input' => 'required|mimes:jpeg,bmp,png,gif|max:20000'
        ]);
        
        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json($messages);
        }else{
            $uniq = uniqid();
            $img =Storage::put(
            'avatars/'.$request->user()->id.'-'.$uniq.'.jpg',
            file_get_contents($request->file('file-input')->getRealPath())
            );

            if($img){
                $User = User::find($request->user()->id);
                $User->image     =  'storage/avatars/'.$request->user()->id.'-'.$uniq.'.jpg';
                $User->save();
            }
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
        //print_r($request->all());

        $validator = Validator::make($request->all(), [
            'nombre'    => 'required|min:4|max:40|string',
            'apellido'  => 'required|min:4|max:40|string',
            'correo'    => 'required|email|unique:users,email,'.$id,
            'usuario'   => 'required|min:4|max:40|alpha_num|unique:users,usuario,'.$id,
            'password'  => 'min:6|max:40|alpha_num',
            'rol'       => 'required|min:1|max:2|numeric',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json($messages);
        }else{

            $User = User::find($id);
            $User->name     = $request->nombre;
            $User->apellido = $request->apellido;
            $User->email    = $request->correo;
            $User->usuario  = $request->usuario;
            if(!empty($request->password)){
              $User->password = bcrypt($request->password);  
            }
            $User->idrol    = $request->rol;
            return response()->json($User->save());
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
        //
    }


    public function anyData(){
        //$datos = User::select([])->get();
        return Datatables::of(User::all())
        ->addColumn('check',function($user){
            return '<label class="pos-rel"><input type="checkbox" class="ace"><span class="lbl" id="'.$user->id.'"></span></label>';
        })
        ->addColumn('rol',function($user){
            if($user->idrol==1){
                $rol = "Administrador";
            }
            elseif ($user->idrol==2) {
                $rol = "Usuario";
            }
            return $rol;
        })
        /*->addColumn('avatar',function($user){
            return '<img src="'.$user->image.'" width="40">';
        })*/
        ->addColumn('edit',function($user){
            return '<a ng-click="modalUser(2,'.$user->id.')" class="green"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
        })
        ->make(true);
    }

    public function dataUser($id=null){
        if(empty($id))
            return response()->json(User::all());
        else
            return response()->json(User::find($id));
    }
}
