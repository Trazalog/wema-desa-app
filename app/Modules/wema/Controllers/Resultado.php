<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Resultados;
use Modules\wema\Models\Cuentas;
use Modules\wema\Models\Generales;
use Modules\wema\Models\Clientes;

class Resultado extends BaseController
{
    public function __construct(){

        $this->Resultados = new Resultados();
        $this->Generales = new Generales();
        $this->Cuentas = new Cuentas();
        $this->Clientes = new Clientes();
    }

    /**
        * Pantalla con resultados de navegacion por cuentas
        * @param 
        * @return view colonias, ubicaciones, municipios, etc
    */
    function index(){
        log_message('info','#TRAZA | WEMA-DESA-APP | Cuenta | index()');
        $request = \Config\Services::request();
        
        $data['listadoEmpresas'] = $this->Cuentas->getEmpresas();
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");
        $data['listadoPersonas'] = $this->Generales->getTabla("tipos_personas");
        $data['listadoTipompresas'] = $this->Generales->getTabla("tipos_empresas");
        $data['listadoCliente'] = $this->Generales->getTabla("tipos_clientes");
        $data['listadoPaises'] = $this->Generales->getTabla("paises");

        return view('Modules\wema\Views\resultados\cuentas',$data);
    }
    /**
        * Carga pantalla de Clientes por empr_id para ver navegar por resultados
        * @param  empr_id  id de la empresa
        * @return view index.php 
	*/
    public function clientes($empr_id = null){
        log_message('info','#TRAZA | WEMA-DESA-APP | Cuenta | clientes($empr_id)'.$empr_id);
        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");

        /* LISTADO TIPO PERSONAS */
        $data['tipoPersona'] = $this->Generales->getTabla("tipos_personas");

        /* LISTADO TIPO CLIENTES */
        $data['tipoCliente'] = $this->Generales->getTabla("tipos_clientes");

        /* LISTADO DE CLIENTES */
        $data['listadoClientes'] = $this->Cuentas->getClientes($empr_id);

        $data['empr_id'] = $empr_id;

        return view('Modules\wema\Views\resultados\clientes', $data)
        .view('Modules\wema\Views\cuentas\modalGenericoCuenta');
    }
    /**
        * Recibe id del cliente
        * @param  array $clie_id cliente
        * @return view personas
    */
    public function personas($clie_id = null){

        /* LISTADO PERSONAS */
        $data['listadoPersonas'] = $this->Clientes->getPersonas($clie_id);

        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");

        /* LISTADO ESTADO CIVIL */
        $data['listadoEstadoCivil'] = $this->Generales->getTabla("estados_civiles");
      
        /* LISTADO NIVELES EDUCATIVOS */
        $data['listadoNivelEducativo'] = $this->Generales->getTabla("niveles_educativos");

        $data['clie_id'] = $clie_id;
        
        return view('Modules\wema\Views\resultados\personas',$data)
        .view('Modules\wema\Views\clientes\modalGenericoCliente')
        .view('Modules\wema\Views\resultados\modales\modalResultados');
    }
    /**
        * Devuelve el listado de las encuetas para un pers_id
        * @param  integer $pers_id
        * @return array evaluaciones
    */
    public function getEvaluacionesPersona($pers_id = null){
        log_message('info','#TRAZA | WEMA-DESA-APP | Resultado | getEvaluacionesPersona($pers_id) -> '.$pers_id);
        
        if(!empty($pers_id)){
            $rsp = $this->Resultados->getEvaluacionesPersona($pers_id);
            echo json_encode($rsp);
        }else{
            echo json_encode(array("status" => false, "msg" => "Parametro pers_id esta vacio"));
        }
    }
}
