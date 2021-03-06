<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\RegProveedor;
use App\Prov_Cat;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\RegistrosProveedorFormRequest;
use Auth;
use Session;

use DB;
//use Redirect;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;

use Hash;
use Validator;

class RegistrosProveedorController extends Controller
{
    public function __construct(){

    }
    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('searchText'));
    		$proveedores=DB::table('proveedor')->where('proveedor','LIKE','%'.$query.'%')
    		->where('privilegio','=','0')
    		->orderBy('id','desc')
    		->paginate(7);
    		return view('registrosproveedor.index',["proveedores"=>$proveedores,"searchText"=>$query]);
    	}
    }
    public function create(){
         $categorias=DB::table('categoria')
        ->select('idcat','nombre')
        ->get();
    	return view("registrosproveedor.create",["categorias"=>$categorias]);
    }
    public function store(RegistrosProveedorFormRequest $request){
    	try{
            DB::beginTransaction();

                $proveedor=new RegProveedor;
            	$proveedor->correo=$request->get('correo');
            	//$proveedor->password=$request->get('password');
                      
                $pass = substr(MD5(rand(5, 100)), 0, 8);
                     
                $proveedor->password= bcrypt($pass);

                // para desencriptar--
                // Crypt::decrypt($pass);

            	$proveedor->proveedor=$request->get('proveedor');
            	$proveedor->telefono=$request->get('telefono');
            	$proveedor->direccion=$request->get('direccion');
            	$proveedor->privilegio='0';
            	$proveedor->save();


            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
    	return Redirect::to('registrosproveedor');

    }
   




    public function edit($id){
        return view("registrosproveedor.edit",["proveedor"=>RegProveedor::findOrFail($id)]);
    } 
    public function update(RegistrosProveedorFormRequest $request,$id){
    	$proveedor=RegProveedor::findOrFail($id);
    	$proveedor->correo=$request->get('correo');
    	$proveedor->password=$request->get('password');
    	$proveedor->proveedor=$request->get('proveedor');
    	$proveedor->telefono=$request->get('telefono');
    	$proveedor->direccion=$request->get('direccion');
    	$proveedor->update();
    	return Redirect::to('registrosproveedor');
    }

    public function password(){
        return View('registrosproveedor.password');
    }

    public function show(){
        return View('registrosproveedor.password');
    }

    public function updatePassword(Request $request){
        $rules = [
            'mypassword' => 'required',
            'password' => 'required|confirmed|min:6|max:18',
        ];
        $messages = [
            'mypassword.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return redirect('registrosproveedor/password')->withErrors($validator);
        }
        else{
            if (Hash::check($request->get('mypassword'),Auth::user()->password)){
                DB::table('proveedor')->where('id', Auth::user()->id)->update(['password' => bcrypt($request->get('password')) ]);

                return redirect('registrosproveedor/password')->with('message', 'Password cambiado con éxito');
            }
            else
            {
                return redirect('registrosproveedor/password')->with('message', 'Credenciales incorrectas');
            }
        }

    }

    public function adjuntar_categoria(Request $request){

        //try { 

                DB::beginTransaction(); 

              
               Prov_Cat::create([
                    'id' => $request['txtid'],
                    'idcat' => $request['cbocategoria'],
                      
                ]);


                Session::flash('message','CATEGORIA ADJUDICADA.');

                DB::commit();

                return Redirect::to('/registrosproveedor');

          //  } catch (\Exception $e) {

                //DB::rollback();

                //Session::flash('message-error','Error, intente nuevamente, o contáctese con el administrador.');
              //  return Redirect::to('/registrosproveedor');
            //}

    }

   // public function destroy(){

    //}

}
//--registrar proveedor ruta para REGISTRO DE PROVEEDORES 15-02-18 !!Daniel Alanis