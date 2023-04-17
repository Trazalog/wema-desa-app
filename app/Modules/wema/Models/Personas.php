<?php 

namespace Modules\wema\Models;

use CodeIgniter\Model;

class Personas extends Model{

    public function getPersonas(){
        $url = REST_PERSONA.'persona/';
        return $url;
    }
}