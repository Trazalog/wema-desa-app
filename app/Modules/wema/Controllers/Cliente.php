<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Clientes; 
use Modules\wema\Models\Generales; 



class Cliente extends BaseController
{

    public function __construct()
    {
        $this->Clientes = new Clientes();
        $this->Generales = new Generales();
    }
    /**
        * Carga pantalla principal de ABM clientes
        * @param  
        * @return view index.php
	*/
    public function index()
    {

        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");

        /* LISTADO TIPO PERSONAS */
        $data['tipoPersona'] = $this->Generales->getTabla("tipos_personas");

        /* LISTADO CLIENTES */
        $data['tipoCliente'] = $this->Generales->getTabla("tipos_clientes");


        return view('Modules\wema\Views\clientes\index', $data);
    }


    /**
        * Recibe request con datos de cliente para ALTA
        * @param  array datos cliente
        * @return array response servicio
	*/
    public function guardarCliente(){
        $request = \Config\Services::request();
        $nombreCli = $request->getPost('nombreComercial');
        return json_encode($nombreCli);
    }
}