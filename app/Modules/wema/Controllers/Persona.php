<?php
 
namespace App\Controllers;
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Personas; 
use Modules\wema\Models\Generales; 
use Modules\wema\Models\Clientes; 
use Modules\traz_comp_formularios\Models\Forms; 


class Persona extends BaseController
{
    public function __construct()
    {
        $this->Personas = new Personas();
        $this->Generales = new Generales();
        $this->Clientes = new Clientes();

    }
    /**
        * Carga pantalla principal de ABM personas
        * @param  
        * @return view index.php
	*/
    public function index(){

        /* LISTADO PERSONAS */
        $data['listadoPersonas'] = $this->Personas->getPersonas();

        /* LISTADO PERSONAS */
        $data['listadoClientes'] = $this->Clientes->getClientes();

        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");

        /* LISTADO ESTADO CIVIL */
        $data['listadoEstadoCivil'] = $this->Generales->getTabla("estados_civiles");
      
        /* LISTADO NIVELES EDUCATIVOS */
        $data['listadoNivelEducativo'] = $this->Generales->getTabla("niveles_educativos");


        return view('Modules\wema\Views\persona\index',$data).view('Modules\wema\Views\clientes\modalGenericoCliente');
    }

    /**
        * Recibe request con datos de persona para ALTA
        * @param  array datos persona
        * @return array response servicio
	*/
    public function guardarPersona(){
        $request = \Config\Services::request();

        $fotoPerfil = $request->getFile('imagen');

        $data['post_persona'] = array(
            
            'apellidos' => $request->getPost('apellidos'),
            'nombres' => $request->getPost('nombres'),
            'curp' => $request->getPost('curp'),
            'fec_nacimiento' => $request->getPost('fechaNacimiento'),
            'ocupacion'=>  $request->getPost('ocupacion'),
            'telefono' =>  $request->getPost('telefono'),
            'email' =>  $request->getPost('correo'),
            'calle' =>  $request->getPost('calle'),
            'num_exterior' =>  $request->getPost('numeroExterior'),
            'cod_postal' =>  $request->getPost('CodigoColonia'),
            'num_interior' => $request->getPost('numeroInterior'),
            'usr_app_alta' =>  userNick(),
            'usr_app_ult_modif' =>   '',
            'gene_id' =>  $request->getPost('genero'),
            'pana_id' =>  $request->getPost('paisNacimiento'),
            'esci_id' =>  $request->getPost('estadoCivil'),
            'naci_id' =>  $request->getPost('nacionalidad'),
            'educ_id' =>  $request->getPost('escolaridad'),
            'ubic_id' =>  $request->getPost('nacionalidad'),
            'clie_id' =>  $request->getPost('clie_id'),
            'imagen' => !empty($_FILES['imagen']['name'])  ? base64_encode(file_get_contents($fotoPerfil->getTempName())) : '',
            'nom_imagen' => !empty($_FILES['imagen']['name'])  ? $fotoPerfil->getName() : ''
        );

        $resp = $this->Personas->guardarPersona($data);
        
        echo json_encode($resp);

    }
    /**
        * Recibe request con datos de persona para EDITAR
        * @param  array datos persona
        * @return array response servicio
	*/
    public function editarPersona(){
        $request = \Config\Services::request();
        
        $fotoPerfil = $request->getFile('imagen'); 

        $data['put_persona'] = array(
            'pers_id'=> $request->getPost('pers_id'),
            'apellidos' => $request->getPost('apellidos'),
            'nombres' => $request->getPost('nombres'),
            'curp' => $request->getPost('curp'),
            'fec_nacimiento' => $request->getPost('fechaNacimiento'),
            'ocupacion'=>  $request->getPost('ocupacion'),
            'telefono' =>  $request->getPost('telefono'),
            'email' =>  $request->getPost('correo'),
            'calle' =>  $request->getPost('calle'),
            'num_exterior' =>  $request->getPost('numeroExterior'),
            'cod_postal' =>  $request->getPost('CodigoColonia'),
            'num_interior' => $request->getPost('numeroInterior'),
            'usr_app_alta' =>   'koke',
            'usr_app_ult_modif' =>   'koke',
            'gene_id' =>  $request->getPost('genero'),
            'pana_id' =>  $request->getPost('paisNacimiento'),
            'esci_id' =>  $request->getPost('estadoCivil'),
            'naci_id' =>  $request->getPost('nacionalidad'),
            'educ_id' =>  $request->getPost('escolaridad'),
            'ubic_id' =>  $request->getPost('nacionalidad'),
            'clie_id' =>  $request->getPost('clie_id'),
            'imagen' => !empty($_FILES['imagen']['name'])  ? base64_encode(file_get_contents($fotoPerfil->getTempName())) : '',
            'nom_imagen' => !empty($_FILES['imagen']['name'])  ? $fotoPerfil->getName() : ''
        );

        $resp = $this->Personas->editarPersona($data);

        echo json_encode($resp);
    }

    /**
     * Recibe id Persona a editar area y posicion
     * @param  $pers_id
     * @param  $area
     * @param  $posicion
     * @return array response servicio
     * 
    */
    function editarAreaPosicion(){
        $request = \Config\Services::request();

        $data['put_editarareaposicion'] = array(
            'pers_id' => $request->getPost('pers_id'),
            'area'    => $request->getPost('area'),
            'posicion' => $request->getPost('puesto')
        );

        log_message('debug', "#TRAZA | WEMA-DESA-APP | Persona | Editar | AreaPosicion:  ".json_encode($data));


        $resp = $this->Personas->editarAreaPosicion($data);
        
        echo json_encode($resp);
    }
    /**
        * Recibe id de la persona a eliminar
        * @param  $pers_id
        * @return array response servicio
	*/
    public function eliminarPersona($pers_id = null){

        $data['delete_persona'] = array(
            'pers_id' => $pers_id
        );
        
        $resp = $this->Personas->eliminarPersona($data);
        
        echo json_encode($resp);
        
    }
    /**
        * Recibe id de la persona a habilitar
        * @param  $pers_id
        * @return array response servicio
    */
    public function habilitarPersona($pers_id = null){
        
        $data['put_persona'] = array(
            'pers_id' => $pers_id
        );
        
        $resp = $this->Personas->habilitarPersona($data);
        echo json_encode($resp);
    }
    /**
        * 
        * @param  array datos persona
        * @return array response servicio
    */
    public function getPersonas(){
        $resp = $this->Personas->getPersonas();
        return json_encode($resp);
    }
    /**
        * Carga pantalla para entrevistar personas
        * @param  
        * @return view listadoPersonas.php
	*/
    public function cargarListadoEntrevistados(){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Controller | Persona | cargarListadoEntrevistados()');
        $data['listadoPersonas'] = $this->Personas->getPersonas();
        return view('Modules\wema\Views\persona\entrevistas\listadoPersonas',$data);    
    }
    /**
        * Pantalla con cuestionario para reazliar entrevista
        * @param $pers_id id de persona entrevistado
        * @return view cuestionario.php
	*/
    public function initCuestionario($pers_id){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Controller | Persona | initCuestionario()');

        if(!empty($pers_id)) $data['persona'] = $this->Personas->getPersonaPorId($pers_id);
        
        return view('Modules\wema\Views\persona\entrevistas\cuestionario',$data);    
    }
    /**
        * Vincula el info_id de la instancia generada con la persona entrevistada
        * @param $pers_id id de entrevistada; $info_id id del cuestionario
        * @return array respuesta del servicio
	*/
    public function vincularCuestionario($pers_id,$info_id){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Controller | Persona | vincularCuestionario()');

        if(!empty($pers_id) && !empty($info_id)){
            $resp = $this->Personas->vincularCuestionario($pers_id,$info_id);
        } else{
            $resp = array("status"=> "false", "msg" => "No se vinculo el cuestionario.");
        }
        echo json_encode($resp);        
    }


    public function modalCliente($clie_id = null){
        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");

        /* LISTADO TIPO PERSONAS */
        $data['tipoPersona'] = $this->Generales->getTabla("tipos_personas");

        /* LISTADO TIPO CLIENTES */
        $data['tipoCliente'] = $this->Generales->getTabla("tipos_clientes");

        $data['cliente'] = $this->Clientes->getClientexId($clie_id);

        return view('Modules\wema\Views\clientes\modalCliente', $data);
    }

    /**
        * Recibe id del cliente
        * @param  array $clie_id cliente
        * @return view personas
    */
    function getPersonasxIdClientes($clie_id)
    {
        /* LISTADO DE CLIENTES */
        $resp = $this->Clientes->getPersonas($clie_id);
         
        echo json_encode($resp);
    }
    /**
        * Obtiene audio codificado, lo decodifica y lo guarda en al raiz del proyecto para posteriormente
        * enviar esa URL a la API de EMLO para ser evaluado
        * @param $info_id Id del cuestionario a evaluar
        * @return array respuesta del procedimiento
	*/
    public function evaluarCuestionario($info_id){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Controller | Persona | evaluarCuestionario($info_id)');
        $this->Forms = new Forms();
        $resp = array('status'=> "true");

        //1° Obtengo los audios
        $audios = $this->Forms->getAudios($info_id);
        //2° Creo la carpeta para guardar los audios
        $carpetaTemporal = './audioTemp/evaluate_'.rand(1, 10000);
        $folder = mkdir($carpetaTemporal, 0777, TRUE);
        //3° Decodifico los audios y los guardo en la ruta temporal
        if(!$folder){
            $resp['carpetaTemporal'] = "Error al crear la carpeta, revisar permisos en el servidor";
            log_message('debug','#TRAZA | WEMA-DESA-APP | Controller | Persona | evaluarCuestionario($info_id) -> NO SE CREO LA CARPETA - REVISAR PERMISOS');
        } else{
            $resp['carpetaTemporal']['crear']  = "Se creo la carpeta correctamente.";
            foreach ($audios as $key => $audio) {
                if(!empty($audio->valor4_base64)){
                    $audioDecodificado = pg_unescape_bytea($audio->valor4_base64);
                    if(!file_put_contents($carpetaTemporal.'/'.$audio->name.'.wav',base64_decode($audioDecodificado))){
                        $resp['audios'][$audio->name]['status'] = false;
                        $resp['audios'][$audio->name]['msg'] = 'Fallo al crear el audio en el sistema.';
                    }else{
                        $aux = explode("/",$carpetaTemporal);
                        $data['ubicacion'] = array_pop($aux);
                        $data['nombre'] = $audio->name;
                        $data['inst_id'] = $audio->inst_id;
                        $this->Personas->evaluarCuestionario($data);

                        $resp['audios'][$audio->name]['status'] = true;
                        $resp['audios'][$audio->name]['msg'] = 'Audio decodificado y creado correctamente.';
                    }
                }
            }
        }
        //4° Llamo a la API para evaluar los audios y guardo las respuestas
        #script..

        //5° Limpio la carpeta generada y elimino la carpeta luego de vaciarla
        if (!is_dir($carpetaTemporal)) {
            log_message('debug','#TRAZA | WEMA-DESA-APP | Controller | Persona | evaluarCuestionario($info_id) -> NO EXISTE LA CARPETA, ERROR AL CREAR');
            $resp['status'] = false;
            $resp['carpetaTemporal']['validar'] = 'Error en la validacion de la carpeta, no se creo en el destino especificado -> '.$carpetaTemporal;
        }else{
            //Limpio contenido 
            $files = glob($carpetaTemporal . '/*');//Obtengo el contenido de la carpeta
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            // Elimino la carpeta
            if(rmdir($carpetaTemporal)){
                $resp['carpetaTemporal']['eliminar'] = 'Se elimino la carpeta temporal correctamente.';
            }else{
                $resp['status'] = false;
                $resp['carpetaTemporal']['eliminar'] = 'Error en la eliminacion de la carpeta temporal.';
            }
        }

        echo json_encode($resp);        
    }
}
