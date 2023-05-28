<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Personas; 
use Modules\wema\Models\Generales; 
use Modules\wema\Models\Clientes; 


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
            'clie_id' =>  empresa(),
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
            'clie_id' =>  empresa(),
            'imagen' => !empty($_FILES['imagen']['name'])  ? base64_encode(file_get_contents($fotoPerfil->getTempName())) : '',
            'nom_imagen' => !empty($_FILES['imagen']['name'])  ? $fotoPerfil->getName() : ''
        );

        $resp = $this->Personas->editarPersona($data);

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
        * Carga pantalla con entrevistas para personas
        * @param  
        * @return view entrevistas.php
	*/
    public function cargarEntrevista(){
        $data['listadoPersonas'] = $this->Personas->getPersonas();
        return view('Modules\wema\Views\persona\entrevistas',$data);    
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

}
