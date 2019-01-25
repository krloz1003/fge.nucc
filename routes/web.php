<?php
use Illuminate\Http\Request;
// Registro de modulo autorizado para solicitud de NUC
Route::get('/regmod1', function () {
    /**
     * Para poder ingresar a la ruta de alta de modulo el proyecto no debera
     * contener dentro del .env la variable CLAVE, ya que esta es asignada al
     * momento de registrar el modulo ante el API_NUC.
     * 
     * Si la clave no existe nos mandara a la vista para poder registrar nuestro modulo.
     * Si la clave ya existe nos redirecciona a nuestra página principal.
     */
    if(env("CLAVE")==null){
        return view("fge_tok::login-nuc");
    }
    return Redirect::to('/');    
});

/**
 * Cuando se registra por primera vez el módulo pregunta se si existe la clave dentro del .env
 * si la encuentra lo redirecciona a la página principal del proyecto
 * si la clave es null se recibe como parametro el prefix del modulo y lo agrega al
 * .env con una variable llamada CLAVE = prefix(parametro).
 */

Route::get('regmod2/{name}', function ($name) {
    if(env("CLAVE")==null){
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile)."\nCLAVE=".$name;
        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
    return Redirect::to('/');
});

/**
 * Rutas para verifica NUC estas van direccionadas al mismo controlador dentro
 * del paquete fge.nucc.
 */

Route::get('cnucl', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-cnucl");
});

/**
 * Mismo proceso que la ruta anterior.
 */
Route::get('cnucr', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-cnucr");
});

/**
 * Habilita NUC
 */

Route::get('hnuc', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-hnuc");
});

/**
 * Generar NUC: Si existe .env(clave) nos manda a la vista para generar NUC.
 * 
 */
Route::get('gnuc', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-gnuc");
});
Route::get('mnuc', function () {
    if(env("CLAVE")==null){
        return Redirect::to('fge_tok/regmod1');
    }
    return view("fge_tok::form-mnuc");
});