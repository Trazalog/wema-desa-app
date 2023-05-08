<?php 

namespace Modules\wema\Models;

use CodeIgniter\Model;
use App\Libraries\REST;

class Cuentas extends Model{

    public function __construct(){
        
        // $this->db = \Config\Database::connect();
        $this->REST = new REST();
    }
}