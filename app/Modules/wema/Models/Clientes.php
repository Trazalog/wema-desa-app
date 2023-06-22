<?php 

namespace Modules\wema\Models;

use CodeIgniter\Model;
use App\Libraries\REST;

class Clientes extends Model{


    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        $this->REST = new REST();
    }

    /**
        * Listado de clientes
        * @param  
        * @return array listado de clientes en core.clientes
	*/
    public function getClientes(){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Clientes | getClientes()');

        $url = REST_CLIENTE.'/clientes';
        $aux = $this->REST->callAPI("GET",$url);
        $data = json_decode($aux['data']);

        if(!empty($data->clientes->cliente)){
            return $data->clientes->cliente;
        }
        else return array(); 
    }    

     /**
        * Alta de un cliente en core.clientes
        * @param array $data datos cliente
        * @return array respuesta del servicio
	*/
    public function guardarCliente($data){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Clientes | guardarClientes()');

        $url =  REST_CLIENTE.'/clientes';
        $aux = $this->REST->callAPI("POST",$url, $data);

        return $aux;
    }

    /**
        * modifica un cliente en core.clientes
        * @param array $data datos cliente
        * @return array respuesta del servicio
	*/
    public function editarCliente($data){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Clientes | editarClientes()');

        $url =  REST_CLIENTE.'/clientes';
        $aux = $this->REST->callAPI("PUT",$url, $data);

        return $aux;
    }

    public function editarOrganigrama($data){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Clientes | editarOrganigrama()');

        $url = REST_CLIENTE.'/organigrama';
        $aux = $this->REST->callAPI("PUT", $url, $data);

        return $aux;
    }

     /**
        * elimina un cliente en core.clientes
        * @param array $data datos cliente
        * @return array respuesta del servicio
	*/
    public function eliminarCliente($data){
        $url = REST_CLIENTE."/clientes";
        $aux = $this->REST->callAPI("DELETE",$url, $data);
        
        return $aux;
    }

     /**
        * habilita un cliente en core.clientes
        * @param array $data datos cliente
        * @return array respuesta del servicio
	*/
    public function habilitarCliente($data){
        $url = REST_CLIENTE."/habilitarcliente";
        $aux = $this->REST->callAPI("PUT",$url, $data);
        
        return $aux;
    }

    /**
        * trae las personas que pertenecen a un cliente
        * @param array $data datos personas
        * @return array respuesta del servicio
	*/
    public function getPersonas($data){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Clientes | getPersonas()');

        $url = REST_CLIENTE."/clientes/personas/".$data;
        $aux = $this->REST->callAPI("GET",$url);
        $dato = json_decode($aux['data']);
        if(!empty($dato->personas->persona)){
            return $dato->personas->persona;
        }
        else return array(); 
    }

/**
        * Listado de clientes
        * @param  
        * @return array listado de clientes en core.clientes
	*/
    public function getClientexId( $clie_id = null){
        log_message('debug','#TRAZA | WEMA-DESA-APP | Model | Clientes | getClientexId()');

        $url = REST_CLIENTE."/clientes/getCliente/".$clie_id;
        $aux = $this->REST->callAPI("GET",$url);
        $data = json_decode($aux['data']);

        if(!empty($data->clientes->cliente)){
            return $data->clientes->cliente;
        } 
        else return array(); 
    }

}