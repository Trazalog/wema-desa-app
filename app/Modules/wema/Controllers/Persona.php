<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Personas; 
use Modules\wema\Models\Generales; 


class Persona extends BaseController
{
    public function __construct()
    {
        $this->Personas = new Personas();
        $this->Generales = new Generales();
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


        return view('Modules\wema\Views\persona\index',$data);
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

        $data['cuestionario'] = new \stdClass;
        $data['cuestionario']->preguntas = array();
        $data['cuestionario']->preguntas[0] = new \stdClass();
        $data['cuestionario']->preguntas[0]->titulo = "Economía";
        $data['cuestionario']->preguntas[0]->descripcion = "Desarrollo de la pregunta N° 1";
        $data['cuestionario']->preguntas[0]->nota = "Aclaración opcional sobre pregunta N° 1";
        $data['cuestionario']->preguntas[0]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[1] = new \stdClass();
        $data['cuestionario']->preguntas[1]->titulo = "Gestíon";
        $data['cuestionario']->preguntas[1]->descripcion = "Desarrollo de la pregunta N° 2";
        $data['cuestionario']->preguntas[1]->nota = "Aclaración opcional sobre pregunta N° 2";
        $data['cuestionario']->preguntas[1]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[2] = new \stdClass();
        $data['cuestionario']->preguntas[2]->titulo = "Diseño";
        $data['cuestionario']->preguntas[2]->descripcion = "Desarrollo de la pregunta N° 3";
        $data['cuestionario']->preguntas[2]->nota = "Aclaración opcional sobre pregunta N° 3";
        $data['cuestionario']->preguntas[2]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[3] = new \stdClass();
        $data['cuestionario']->preguntas[3]->titulo = "Cultura";
        $data['cuestionario']->preguntas[3]->descripcion = "Desarrollo de la pregunta N° 4";
        $data['cuestionario']->preguntas[3]->nota = "Aclaración opcional sobre pregunta N° 4";
        $data['cuestionario']->preguntas[3]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[4] = new \stdClass();
        $data['cuestionario']->preguntas[4]->titulo = "Cultura";
        $data['cuestionario']->preguntas[4]->descripcion = "Desarrollo de la pregunta N° 4";
        $data['cuestionario']->preguntas[4]->nota = "Aclaración opcional sobre pregunta N° 4";
        $data['cuestionario']->preguntas[4]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[5] = new \stdClass();
        $data['cuestionario']->preguntas[5]->titulo = "Cultura";
        $data['cuestionario']->preguntas[5]->descripcion = "Desarrollo de la pregunta N° 4";
        $data['cuestionario']->preguntas[5]->nota = "Aclaración opcional sobre pregunta N° 4";
        $data['cuestionario']->preguntas[5]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[6] = new \stdClass();
        $data['cuestionario']->preguntas[6]->titulo = "Cultura";
        $data['cuestionario']->preguntas[6]->descripcion = "Desarrollo de la pregunta N° 4";
        $data['cuestionario']->preguntas[6]->nota = "Aclaración opcional sobre pregunta N° 4";
        $data['cuestionario']->preguntas[6]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[7] = new \stdClass();
        $data['cuestionario']->preguntas[7]->titulo = "Cultura";
        $data['cuestionario']->preguntas[7]->descripcion = "Desarrollo de la pregunta N° 4";
        $data['cuestionario']->preguntas[7]->nota = "Aclaración opcional sobre pregunta N° 4";
        $data['cuestionario']->preguntas[7]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[8] = new \stdClass();
        $data['cuestionario']->preguntas[8]->titulo = "Cultura";
        $data['cuestionario']->preguntas[8]->descripcion = "Desarrollo de la pregunta N° 4";
        $data['cuestionario']->preguntas[8]->nota = "Aclaración opcional sobre pregunta N° 4";
        $data['cuestionario']->preguntas[8]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[9] = new \stdClass();
        $data['cuestionario']->preguntas[9]->titulo = "Cultura";
        $data['cuestionario']->preguntas[9]->descripcion = "Desarrollo de la pregunta N° 4";
        $data['cuestionario']->preguntas[9]->nota = "Aclaración opcional sobre pregunta N° 4";
        $data['cuestionario']->preguntas[9]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[10] = new \stdClass();
        $data['cuestionario']->preguntas[10]->titulo = "Cultura";
        $data['cuestionario']->preguntas[10]->descripcion = "Desarrollo de la pregunta N° 4";
        $data['cuestionario']->preguntas[10]->nota = "Aclaración opcional sobre pregunta N° 4";
        $data['cuestionario']->preguntas[10]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        
        return view('Modules\wema\Views\persona\entrevistas\cuestionario',$data);    
    }

}
