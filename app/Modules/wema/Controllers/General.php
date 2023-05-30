<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Generales; 

class General extends BaseController
{
    public function __construct(){

        $this->Generales = new Generales();
    }


    /**
        * Recibe el valor por el cual buscar colonia
        * @param 
        * @return view colonias, ubicaciones, municipios, etc
    */
    function getUbicaciones()
    {
        $request = \Config\Services::request();
        
        $dato = $request->getGet('patron');   
        /* LISTADO DE UBICACIONS QUE HACEN MATCH CON $dato*/
        $resp = $this->Generales->getUbicaciones($dato);
         
        echo json_encode($resp);
    }
}
