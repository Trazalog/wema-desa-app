<?php 

namespace Modules\wema\Models;

use CodeIgniter\Model;

class Personas extends Model{


    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function getPersonas(){
        $url = REST_PERSONA.'persona/';
        $aux = $this->REST->callAPI("GET",$url);
        $data = json_decode($aux['data']);
        return $data;
    }
}