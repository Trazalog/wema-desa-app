<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Cuentas; 
use Modules\wema\Models\Personas; //Provisorio para Pruebas con DB
use Modules\wema\Models\Generales; 


class Cuenta extends BaseController
{
    public function __construct(){

        $this->Cuentas = new Cuentas();
        $this->Personas = new Personas();
        $this->Generales = new Generales();
    }

    public function index(){

        /* LISTADO CUENTAS - Adapatar a Cuentas, ahora trae personas */
        $data['listadoCuentas'] = $this->Personas->getPersonas();
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoCuentas:  ".json_encode($data['listadoCuentas']));

        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoGeneros: ".json_encode($data['listadoGeneros']));

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoPaises: ".json_encode($data['listadoPaises']));

        /* LISTADO ESTADO CIVIL */
        $data['listadoEstadoCivil'] = $this->Generales->getTabla("estados_civiles");
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoEstadoCivil: ".json_encode($data['listadoEstadoCivil']));
      
        /* LISTADO NIVELES EDUCATIVOS */
        $data['listadoNivelEducativo'] = $this->Generales->getTabla("niveles_educativos");
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoNivelEducativo: ".json_encode($data['listadoNivelEducativo']));


        return view('Modules\wema\Views\cuentas\index',$data);
    }
}