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
        $this->Generales = new Generales();
    }

    public function index(){

        /* LISTADO CUENTAS - Adapatar a Cuentas, ahora trae personas */
        $data['listadoEmpresas'] = $this->Cuentas->getEmpresas();
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoEmpresas:  ".json_encode($data['listadoEmpresas']));

        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoGeneros: ".json_encode($data['listadoGeneros']));
        
        /* LISTADO DE PERSONAS */
        $data['listadoPersonas'] = $this->Generales->getTabla("tipos_personas");
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoGeneros: ".json_encode($data['listadoPersonas']));
        
        /* LISTADO DE PERSONAS */
        $data['listadoTipompresas'] = $this->Generales->getTabla("tipos_empresas");
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoGeneros: ".json_encode($data['listadoTipompresas']));

        /* LISTADO TIPO CLIENTES */
        $data['listadoCliente'] = $this->Generales->getTabla("tipos_clientes");
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoCliente: ".json_encode($data['listadoCliente']));

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | listadoPaises: ".json_encode($data['listadoPaises']));

        return view('Modules\wema\Views\cuentas\index',$data);
    }

    /**
        * 
        * @param  array datos cuents
        * @return array response servicio
    */
    public function getEmpresas(){
        $resp = $this->Clientes->getEmpresas();
        echo json_encode($resp);
    }

    /**
        * Recibe request con datos de cliente para ALTA
        * @param  array datos cliente
        * @return array response servicio
	*/
    public function guardarCuenta(){
        $request = \Config\Services::request();

        $fotoPerfil = $request->getFile('imagen');

        $data['post_empresas'] = array(
            
            'nombre' => $request->getPost('nombreCuenta'),
			'id_tributario' => $request->getPost('rfcCuenta'),
            'num_telefono' =>  $request->getPost('telefono'),            
            'email' =>  $request->getPost('correo'),
            'calle' =>  $request->getPost('calle'),
            'num_exterior' =>  $request->getPost('numeroExterior'),            
            'cod_postal' =>  $request->getPost('CodigoColonia'),
			'num_interior' => $request->getPost('numeroInterior'),
            'razon_social' => $request->getPost('razonSocial'),
            'representante_legal' => $request->getPost('representanteLegal'),
            'id_persona' => $request->getPost('curp'),
            'apellidos' => $request->getPost('apellidos'),
            'nombres' => $request->getPost('nombres'),
            'fec_nacimiento' => $request->getPost('fechaNacimiento'),
            'ocupacion'=>  $request->getPost('ocupacion'),
            'usr_alta' =>  'koke',
            'usr_app_alta' =>   'koke',
			'tiem_id' => $request->getPost('tipoCuenta'),
			'tipe_id' => $request->getPost('tipoPersona'),
			'naci_id' => $request->getPost('nacionalidad'),
			'gene_id' => $request->getPost('genero'),
			'ubic_id' => $request->getPost('paisNacimiento'),
			'imagen' => !empty($_FILES['imagen']['name'])  ? base64_encode(file_get_contents($fotoPerfil->getTempName())) : '',
            'nom_imagen' => !empty($_FILES['imagen']['name'])  ? $fotoPerfil->getName() : '',
        );

        $resp = $this->Cuentas->guardarCuenta($data);
        
        echo json_encode($resp);

    }

    /**
        * Recibe request con datos de cuenta para actualziar
        * @param  array datos cuenta
        * @return array response servicio
	*/
    public function editarCuenta(){
        $request = \Config\Services::request();

        $fotoPerfil = $request->getFile('imagen');

        log_message('info', "#TRAZA | WEMA-DESA-APP | Cuenta | editarCuenta : ".json_encode($request));


        /*$data['put_empresas'] = array(
            'empr_id'=> $request->getPost(''),
            'nombre' => $request->getPost(''),
            'num_telefono' =>  $request->getPost(''),
            'telefono' =>  $request->getPost(''),
            'email' =>  $request->getPost(''),
            'calle' =>  $request->getPost(''),
            'num_exterior' =>  $request->getPost(''),
            'num_interior' => $request->getPost(''),
            'cod_postal' =>  $request->getPost(''),
            'razon_social' => $request->getPost(''),
            'representante_legal' => $request->getPost(''),
            'id_persona' => $request->getPost(''),
            'apellidos' => $request->getPost(''),
            'nombres' => $request->getPost(''),
            'fec_nacimiento' => $request->getPost(''),
            'ocupacion'=>  $request->getPost(''),
			'fec_alta' => $request->getPost(''),
            'usr_alta' =>  userNick(),
            'usr_app_alta' =>   userNick(),
			'fec_ult_modif' => $request->getPost(''),
			'usr_ult_modif' => userNick(),
			'usr_app_ult_modif' => userNick(),
			'tiem_id' => $request->getPost(''),
			'tipe_id' => $request->getPost(''),
			'naci_id' => $request->getPost(''),
			'gene_id' => $request->getPost(''),
			'ubic_id' => $request->getPost(''),
			'imagen' => !empty($_FILES['imagen']['name'])  ? base64_encode(file_get_contents($fotoPerfil->getTempName())) : '',
            'nom_imagen' => !empty($_FILES['imagen']['name'])  ? $fotoPerfil->getName() : '',
            
            
        );*/

        //$resp = $this->Cuentas->editarCuenta($data);
        
        //echo json_encode($resp);

    }

    /**
        * Recibe id del cuemta
        * @param  $clie_id cuenta
        * @return array response servicio
    */
    public function eliminarCuenta($empr_id = null){
        
        $data['delete_empresas'] = array(
            'empr_id' => $empr_id
        );
        log_message('info', "#TRAZA | WEMA-DESA-APP | Cuenta | eliminarCuenta : ".json_encode($data['delete_empresas']));
        $resp= $this->Cuentas->eliminarCuenta($data);
        log_message('info', "#TRAZA | WEMA-DESA-APP | Cuenta | eliminarCuenta : ".json_encode($resp));

        echo json_encode($resp);
    }
    /**
        * Recibe id del cliente
        * @param  array $clie_id cliente
        * @return array response servicio
    */
    public function habilitarCuenta($empr_id = null){
        $data['put_habilitarEmpresa'] = array(
            'empr_id' => $empr_id
        );
        log_message('info', "#TRAZA | WEMA-DESA-APP | Cuenta | habilitarCuenta : ".json_encode($data['put_habilitarEmpresa']));
        $resp= $this->Cuentas->habilitarCuenta($data);
        log_message('info', "#TRAZA | WEMA-DESA-APP | Cuenta | habilitarCuenta : ".json_encode($resp));

        echo json_encode($resp);
    }
}