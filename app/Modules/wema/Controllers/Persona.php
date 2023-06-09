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
        $data['cuestionario']->preguntas[0]->pregunta = "¿Como se siente si escucha la frase lorem ipsum?";
        $data['cuestionario']->preguntas[0]->descripcion = "Desarrollo de la pregunta N° 1";
        $data['cuestionario']->preguntas[0]->nota = "Aclaración opcional sobre pregunta N° 1";
        $data['cuestionario']->preguntas[0]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[1] = new \stdClass();
        $data['cuestionario']->preguntas[1]->titulo = "Gestíon";
        $data['cuestionario']->preguntas[1]->pregunta = "¿Esta usted asociado a alguna actividad ilícita en la empresa?";
        $data['cuestionario']->preguntas[1]->descripcion = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut purus in justo aliquet ornare. Curabitur pulvinar nunc et erat convallis consectetur. Duis facilisis sollicitudin lorem, ac tempor nibh vehicula eu. Integer at nunc quis ex rutrum sagittis. Vestibulum augue enim, laoreet scelerisque vestibulum ut, convallis vel ligula. Donec odio arcu, ullamcorper nec eleifend nec, faucibus accumsan libero. Integer tincidunt vestibulum eleifend. Phasellus vel euismod arcu. Nulla cursus urna pellentesque, venenatis nisl nec, vulputate elit.Integer nisi massa, fringilla ornare hendrerit quis, laoreet ut sem. Suspendisse euismod semper ex, non volutpat mauris faucibus eu. Fusce commodo quam in tincidunt condimentum. Maecenas suscipit erat sit amet nisl feugiat interdum. Vestibulum nulla eros, porta nec scelerisque sed, malesuada ac diam. Sed quis tristique ligula. Nulla vehicula mi massa, pellentesque lobortis lorem cursus eu.";
        $data['cuestionario']->preguntas[1]->nota = "Aclaración opcional sobre pregunta N° 2";
        $data['cuestionario']->preguntas[1]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[2] = new \stdClass();
        $data['cuestionario']->preguntas[2]->titulo = "Diseño";
        $data['cuestionario']->preguntas[2]->pregunta = "¿Usted vio algo inusual en el comportamiento de su compañero?";
        $data['cuestionario']->preguntas[2]->descripcion = "Desarrollo de la pregunta N° 3";
        $data['cuestionario']->preguntas[2]->nota = "Aclaración opcional sobre pregunta N° 3";
        $data['cuestionario']->preguntas[2]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        $data['cuestionario']->preguntas[3] = new \stdClass();
        $data['cuestionario']->preguntas[3]->titulo = "Cultura";
        $data['cuestionario']->preguntas[3]->pregunta = "¿Presenció alguna actividad ilícita en su jornada laboral?";
        $data['cuestionario']->preguntas[3]->descripcion = "Desarrollo de la pregunta N° 4";
        $data['cuestionario']->preguntas[3]->nota = "Aclaración opcional sobre pregunta N° 4";
        $data['cuestionario']->preguntas[3]->video = "https://share.synthesia.io/embeds/videos/7afef1d6-1f8b-45ee-961e-e22a6aa94f6f";
        
        return view('Modules\wema\Views\persona\entrevistas\cuestionario',$data);    
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

}
