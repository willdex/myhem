<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;

use Auth;
use Session;
use Redirect;
use DB;

class ProveedoresController extends Controller {

  public function __construct(Request $request) {
         $this->middleware('auth');
         $this->middleware('admin');
        $this->middleware('auth',['only'=>'admin']);
        
    }
  
    function index() {  

        /*
            $prov=DB::table('prov_cat')
            ->join('categoria','categoria.idcat','=','prov_cat.idcat')
            ->join('proveedor','proveedor.id','=','prov_cat.id')
            ->select('proveedor', 'correo', 'telefono', 'direccion')    */

            $prov=DB::table('proveedor')
            ->select('proveedor', 'correo', 'telefono', 'direccion')            

            ->paginate(10);   

            return view('proveedor.proveedores',['prov'=>$prov]);     
                
    }
   


    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request) {
        
    }



    public function logout() {

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
