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

        return $data->personas->persona;
    }
    /**
        * Alta de una persona en core.personas
        * @param array $data datos persona
        * @return array listado de personas en core.personas
	*/
    public function guardarPersona($data){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Personas | guardarPersona()');

        $url = REST_PERSONA."/persona";

        $aux = $this->REST->callAPI("POST",$url, $data);

        return $aux;
    }
}