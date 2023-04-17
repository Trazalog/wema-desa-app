<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;

class Persona extends BaseController
{
    public function index()
    {
        $url = "http://10.142.0.13:8280/services/PersonaDataService/persona";

        $aux = $this->REST->callAPI("GET",$url);
        $resp = json_decode($aux['data']);
        $data['listadoPersonas'] = $resp;
        var_dump($data);
        return view('Modules\wema\Views\persona\index',$data);
    }
}
