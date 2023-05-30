<?php 

namespace Modules\wema\Models;

use CodeIgniter\Model;
use App\Libraries\REST;

class Generales extends Model{


    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        $this->rest = new REST();
    }

    /**
        * Obtiene listado de valores para el parametro $tabla 
        * @param  $tabla string; 
        * @return array listado con unidades de medida
	*/
    public function getTabla($tabla){
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Model | Generales | getTabla($tabla)");
        
        $url = REST_CORE."/tabla/$tabla";

        $aux = $this->rest->callAPI("GET",$url);
        $resp = json_decode($aux['data']);

        if(!empty($resp->tablas->tabla)){
            return $resp->tablas->tabla;
        }else{
            return array();
        }
    }


}