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
    public function getEmpresas(){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Cuentas | getEmpresas()');

        $url = REST_EMPRESA.'/empresas';
        $aux = $this->REST->callAPI("GET",$url);
        $data = json_decode($aux['data']);

        if(!empty($data->empresas->empresa))
            return $data->empresas->empresa;
        else    
            return array();
    }

    /**
        * Alta de un cuenta en core.empresas
        * @param array $data datos cuentas
        * @return array respuesta del servicio
	*/
    public function guardarCuenta($data){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Cuentas | guardarCuenta()');

        $url =  REST_EMPRESA.'/empresas';
        $aux = $this->REST->callAPI("POST",$url, $data);

        return $aux;
    }


    /**
        * modifica un cuentas en core.empresas
        * @param array $data datos cuentas
        * @return array respuesta del servicio
	*/
    public function editarCuenta($data){
        log_message('info','#TRAZA | WEMA-DESA-APP | Model | Cuentas | editarCuenta()');

        $url =  REST_EMPRESA.'/empresas';
        $aux = $this->REST->callAPI("PUT",$url, $data);

        return $aux;
    }

    /**
        * elimina un cliente en core.empresas
        * @param array $data datos cuenta
        * @return array respuesta del servicio
	*/
    public function eliminarCuenta($data){
        $url = REST_EMPRESA."/empresas";
        $aux = $this->REST->callAPI("DELETE",$url, $data);
        
        return $aux;
    }

     /**
        * habilita un cliente en core.empresas
        * @param array $data datos cuenta
        * @return array respuesta del servicio
	*/
    public function habilitarCuenta($data){
        $url = REST_EMPRESA."/habilitarEmpresa";
        $aux = $this->REST->callAPI("PUT",$url, $data);
        
        return $aux;
    }
}