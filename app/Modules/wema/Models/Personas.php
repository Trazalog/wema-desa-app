<?php 

namespace Modules\wema\Models;

use CodeIgniter\Model;
use App\Libraries\REST;

class Personas extends Model{


    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        $this->REST = new REST();
    }

    /**
        * Listado de personas
        * @param  
        * @return array listado de personas en core.personas
	*/
    public function getPersonas(){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Personas | getPersonas()');

        $url = REST_PERSONA.'/persona';
        $aux = $this->REST->callAPI("GET",$url);
        $data = json_decode($aux['data']);
        // log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Personas | getPersonas()'.$aux['data']);

        if(!empty($data->personas->persona)){
            return $data->personas->persona;
        }
        else return array(); 
    }
    /**
        * Alta de una persona en core.personas
        * @param array $data datos persona
        * @return array respuesta del servicio
	*/
    public function guardarPersona($data){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Personas | guardarPersona()');

        $url = REST_PERSONA."/persona";
        $aux = $this->REST->callAPI("POST",$url, $data);

        return $aux;
    }

    /**
        * Edita una posiocion y area en core.personas por pers_id
        * @param array $data datos persona
        * @return array respuesta del servicio
	*/
    public function editarAreaPosicion($data){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Personas | editarPersona()');

        $url = REST_PERSONA."/editarareaposicion";
        $aux = $this->REST->callAPI("PUT",$url, $data);

        return $aux;
    }

    /**
        * Edita una persona en core.personas por pers_id
        * @param array $data datos persona
        * @return array respuesta del servicio
	*/
    public function editarPersona($data){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Personas | editarPersona()');

        $url = REST_PERSONA."/persona";
        $aux = $this->REST->callAPI("PUT",$url, $data);

        return $aux;
    }
    /**
        * Obtiene una persona por pers_id(PK)
        * @param $pers_id
        * @return array datos de la persona coincidente en core.personas
	*/
    public function getPersonaPorId($pers_id){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Personas | getPersonas()');

        $url = REST_PERSONA.'/persona/id/'.$pers_id;
        $aux = $this->REST->callAPI("GET",$url);
        $data = json_decode($aux['data']);
        
        return $data->personas->persona;
    }

    /**
        * habilita una persona en core.personas por pers_id
        * @param  $pers_id datos persona
        * @return array respuesta del servicio
	*/
    public function habilitarPersona($data){
        log_message('info','#TRAZA | WEMA-DESA-APP | Model | Personas | habilitarPersona($data)');
        $url = REST_PERSONA."/habilitarpersona";
        
        $aux = $this->REST->callAPI("PUT",$url, $data);

        return $aux;
    }

    /**
        * elimina una persona en core.personas por pers_id
        * @param  $pers_id datos persona
        * @return array respuesta del servicio
	*/
    public function eliminarPersona($data){
        log_message('info','#TRAZA | WEMA-DESA-APP | Model | Personas | eliminarPersona($data)');
        $url = REST_PERSONA."/persona";

        $aux = $this->REST->callAPI("DELETE",$url, $data);

        return $aux;
    }
    /**
        * Vincula el info_id de la instancia generada con la persona entrevistada
        * @param $pers_id datos persona; $info_id instancia generada
        * @return array respuesta del servicio
	*/
    public function vincularCuestionario($pers_id,$info_id){
        log_message('info','#TRAZA | WEMA-DESA-APP | Model | Personas | vincularCuestionario($pers_id,$info_id)');

        $data['post_persona'] = array(
            'pers_id' => $pers_id,
            'info_id' => $info_id
        );
        $url = REST_PERSONA."/persona/cuestionario/vincular";
        $resp = $this->REST->callAPI("POST",$url , $data);

        return $resp;
    }
    /**
        * Llama a la API de EMLO para evaluar el audio y guardar su respuesta en frm.instancias formularios
        * @param $pers_id datos persona; $info_id instancia generada
        * @return array respuesta del servicio
	*/
    public function evaluarCuestionario($data){
        log_message('info','#TRAZA | WEMA-DESA-APP | Model | Personas | evaluarCuestionario()');

        $url = API_EMLO;
        $resp = $this->REST->callAPI("POST",$url , $data);

        return $resp;
    }
}