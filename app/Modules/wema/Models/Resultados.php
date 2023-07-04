<?php 

namespace Modules\wema\Models;

use CodeIgniter\Model;
use App\Libraries\REST;

class Resultados extends Model{

    public function __construct(){
        $this->REST = new REST();
    }

    /**
        * Listado de evalauciones par auna persona por pers_id
        * @param integer $pers_id
        * @return array listado de evaluaciones en eva.evalauciones_personas
	*/
    public function getEvaluacionesPersona($pers_id){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Resultados | getEvaluacionesPersona()');

        $url = REST_PERSONA.'/persona/evaluaciones/'.$pers_id;
        $aux = $this->REST->callAPI("GET",$url);
        $data = json_decode($aux['data']);

        if(!empty($data->evaluaciones->evaluacion))
            return $data->evaluaciones->evaluacion;
        else    
            return array();
    }
}