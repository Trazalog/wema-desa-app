<?php 

namespace Modules\wema\Models;

use CodeIgniter\Model;
use App\Libraries\REST;

class Resultados extends Model{

    public function __construct(){
        $this->REST = new REST();
    }

    /**
        * Listado de Cuentas
        * @param  
        * @return array listado de cuentas en core.cuentas
	*/
    public function getEmpresas(){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Resultados | getEmpresas()');

        $url = REST_EMPRESA.'/empresas';
        $aux = $this->REST->callAPI("GET",$url);
        $data = json_decode($aux['data']);

        if(!empty($data->empresas->empresa))
            return $data->empresas->empresa;
        else    
            return array();
    }
}