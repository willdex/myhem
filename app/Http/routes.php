<?php

/*Route::get('/', function () {
    return view('welcome');
});*/


//LOGIN
Route::resource('/','LoginController');
Route::resource('login','LoginController@store');
Route::resource('logout','LoginController@logout');


Route::get("registrarse","ProveedorController@registrarse");

Route::resource('escritorio','EscritorioController');


Route::resource('convocatoriasaprobadas','ConvocatoriasAprobadasController');

Route::resource('convocatoriasactivas','ConvocatoriasActivasController');
Route::post('adjudicar','ConvocatoriasActivasController@adjudicar_convocatoria');
Route::post('adjudicarParcial','ConvocatoriasActivasController@adjudicar_convocatoria_parcial');
Route::resource('parciales','ConvocatoriasActivasController@parciales');
Route::post('cerrar','ConvocatoriasActivasController@cerrar_convocatoria');

Route::resource('convocatoriasinactivas','ConvocatoriasInactivasController');

Route::get("convocatorias/{id}","ConvocatoriasController@covocatorias");

Route::resource('convocatorias','ConvocatoriasController');


Route::resource("perfil","PerfilController");

Route::resource('ayuda','AyudaController');

Route::resource('mail','MailController');

Route::resource('consulta','ConsultaController');

Route::post('contrasena','ContrasenaControler@index');

Route::resource('ayudaemail','AyudaEmailController@index');

Route::resource('proveedores','ProveedoresController');


//--registrar proveedor ruta para REGISTRO DE PROVEEDORES 15-02-18 !!Daniel Alanis
Route::resource('registrosproveedor','RegistrosProveedorController');
///
Route::get('registrosproveedor/password','RegistrosProveedorController@password');
Route::post('registrosproveedor/updatepassword','RegistrosProveedorController@updatePassword');

Route::post('adjuntarcategoria','RegistrosProveedorController@adjuntar_categoria');

//* adjuntar archivos willians d.

Route::get('form_enviar_correo', 'CorreoController@crear');
Route::post('enviar_correo', 'CorreoController@enviar');
Route::post('cargar_archivo_correo', 'CorreoController@store');
//Route::get('/logout', 'Auth\LoginController@logout');



