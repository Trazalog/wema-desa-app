<?php 

namespace Modules\wema\Models;

use CodeIgniter\Model;
use App\Libraries\REST;

class Cuentas extends Model{

    public function __construct(){
        
        // $this->db = \Config\Database::connect();
        $this->REST = new REST();
    }

    /**
        * Listado de Cuentas
        * @param  
        * @return array listado de cuentas en core.cuentas
	*/
    public function getPersonas(){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Personas | getPersonas()');

        $url = REST_PERSONA.'/persona';
        $aux = $this->REST->callAPI("GET",$url);
        $data = json_decode($aux['data']);

        return $data->personas->persona;
    }
}