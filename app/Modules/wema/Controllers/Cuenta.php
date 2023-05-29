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

        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");
        
        /* LISTADO DE PERSONAS */
        $data['listadoPersonas'] = $this->Generales->getTabla("tipos_personas");
        
        /* LISTADO DE PERSONAS */
        $data['listadoTipompresas'] = $this->Generales->getTabla("tipos_empresas");

        /* LISTADO TIPO CLIENTES */
        $data['listadoCliente'] = $this->Generales->getTabla("tipos_clientes");

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");

        return view('Modules\wema\Views\cuentas\index',$data);
    }

    /**
        * 
        * @param  array datos cuents
        * @return array response servicio
    */
    public function getEmpresas(){
        $resp = $this->Cuentas->getEmpresas();
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
            'usr_app_ult_modif' =>   'koke',
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


        $data['put_empresas'] = array(
            'empr_id'=> $request->getPost('empr_id'),
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
            'usr_app_ult_modif' =>   'koke',
            'usr_app_alta' =>   'koke',
			'tiem_id' => $request->getPost('tipoCuenta'),
			'tipe_id' => $request->getPost('tipoPersona'),
			'naci_id' => $request->getPost('nacionalidad'),
			'gene_id' => $request->getPost('genero'),
			'ubic_id' => $request->getPost('paisNacimiento'),
			'imagen' => !empty($_FILES['imagen']['name'])  ? base64_encode(file_get_contents($fotoPerfil->getTempName())) : '',
            'nom_imagen' => !empty($_FILES['imagen']['name'])  ? $fotoPerfil->getName() : '',
        );

        $resp = $this->Cuentas->editarCuenta($data);
       
        echo json_encode($resp);
       

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

    /**
        * Carga pantalla principal de ABM clientes
        * @param  empr_id  id de la empresa
        * @return view index.php 
	*/
    public function getClientes($empr_id = null)
    {

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

        return view('Modules\wema\Views\clientes\index', $data)
        .view('Modules\wema\Views\cuentas\modalGenericoCuenta');
    }






}