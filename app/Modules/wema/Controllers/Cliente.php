<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Clientes; 
use Modules\wema\Models\Generales; 
use Modules\wema\Models\Personas; 
use Modules\wema\Models\Cuentas; 



class Cliente extends BaseController
{

    public function __construct()
    {
        $this->Clientes = new Clientes();
        $this->Generales = new Generales();
        $this->Cuentas = new Cuentas();

        $this->Personas = new Personas();
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

        /* LISTADO TIPO CLIENTES */
        $data['tipoCliente'] = $this->Generales->getTabla("tipos_clientes");

        /* LISTADO DE CLIENTES */
        $data['listadoClientes'] = $this->Clientes->getClientes();
        //log_message('debug', "#TRAZA | WEMA-DESA-APP | Cliente | Index | Cliente:  ".json_encode($data['listadoClientes'],true));
        
        /* LISTADO DE CLIENTES */
        $data['listadoPersonas'] = $this->Personas->getPersonas();
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cliente | Index | Personas:  ".json_encode($data['listadoPersonas'],true));
        

        return view('Modules\wema\Views\clientes\index', $data)
        .view('Modules\wema\Views\cuentas\modalGenericoCuenta');
    }


    /**
        * Recibe request con datos de cliente para ALTA
        * @param  array datos cliente
        * @return array response servicio
	*/
    public function guardarCliente(){
        $request = \Config\Services::request();

        $fotoPerfil = $request->getFile('imagen');

        $data['post_clientes'] = array(
            
            'nombre' => $request->getPost('nombreComercial'),
            'id_tributario' => $request->getPost('rfc'),
            'telefono' =>  $request->getPost('telefono'),
            'email' =>  $request->getPost('correo'),
            'calle' =>  $request->getPost('calle'),
            'num_exterior' =>  $request->getPost('numeroExterior'),
            'num_interior' => $request->getPost('numeroInterior'),
            'cod_postal' =>  $request->getPost('CodigoColonia'),
            'razon_social' => $request->getPost('razonSocial'),
            'representante_legal' => $request->getPost('representanteLegal'),
            'curp' => $request->getPost('curp'),
            'apellidos' => $request->getPost('apellidos'),
            'nombres' => $request->getPost('nombres'),
            'fec_nacimiento' => $request->getPost('fechaNacimiento'),
            'ocupacion'=>  $request->getPost('ocupacion'),
            'usr_alta' =>  userNick(),
            'usr_app_alta' =>   userNick(),
            'ticl_id' =>  $request->getPost('tipoCliente'),
            'tipe_id' =>  $request->getPost('tipoPersona'),
            'naci_id' =>  $request->getPost('nacionalidad'),
            'gene_id' =>  $request->getPost('genero'),
            'pana_id' =>  $request->getPost('paisNacimiento'),
            'empr_id' =>  $request->getPost('empr_id'),
            'imagen' => !empty($_FILES['imagen']['name'])  ? base64_encode(file_get_contents($fotoPerfil->getTempName())) : '',
            'nom_imagen' => !empty($_FILES['imagen']['name'])  ? $fotoPerfil->getName() : '',
        );

        $resp = $this->Clientes->guardarCliente($data);
        
        echo json_encode($resp);

    }

    /**
        * Recibe request con datos de cliente para ALTA
        * @param  array datos cliente
        * @return array response servicio
	*/
    public function editarCliente(){
        $request = \Config\Services::request();

        $fotoPerfil = $request->getFile('imagen');

        $data['put_clientes'] = array(
            'clie_id'=> $request->getPost('clie_id'),
            'nombre' => $request->getPost('nombreComercial'),
            'id_tributario' =>  $request->getPost('rfc'),
            'telefono' =>  $request->getPost('telefono'),
            'email' =>  $request->getPost('correo'),
            'calle' =>  $request->getPost('calle'),
            'num_exterior' =>  $request->getPost('numeroExterior'),
            'num_interior' => $request->getPost('numeroInterior'),
            'cod_postal' =>  $request->getPost('CodigoColonia'),
            'razon_social' => $request->getPost('razonSocial'),
            'representante_legal' => $request->getPost('representanteLegal'),
            'curp' => $request->getPost('curp'),
            'apellidos' => $request->getPost('apellidos'),
            'nombres' => $request->getPost('nombres'),
            'fec_nacimiento' => $request->getPost('fechaNacimiento'),
            'ocupacion'=>  $request->getPost('ocupacion'),
            'usr_alta' =>  userNick(),
            'usr_app_alta' =>   userNick(),
            'ticl_id' =>  $request->getPost('tipoCliente'),
            'tipe_id' =>  $request->getPost('tipoPersona'),
            'naci_id' =>  $request->getPost('nacionalidad'),
            'gene_id' =>  $request->getPost('genero'),
            'pana_id' =>  $request->getPost('paisNacimiento'),
            'empr_id' =>   $request->getPost('empr_id'),
            'imagen' => !empty($_FILES['imagen']['name'])  ? base64_encode(file_get_contents($fotoPerfil->getTempName())) : '',
            'nom_imagen' => !empty($_FILES['imagen']['name'])  ? $fotoPerfil->getName() : '',
            
        );

        $resp = $this->Clientes->editarCliente($data);
        
        echo json_encode($resp);

    }

    /**
        * 
        * @param  array datos clientes
        * @return array response servicio
    */
    public function getClientes(){
        $resp = $this->Clientes->getClientes();
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cuenta | Index | Cliente:  ".json_encode($resp));

        echo json_encode($resp);
    }

    /**
        * Recibe id del cliente
        * @param  $clie_id cliente
        * @return array response servicio
    */
    public function eliminarCliente($clie_id = null){
        $data['delete_persona'] = array(
            'clie_id' => $clie_id
        );
        $resp= $this->Clientes->eliminarCliente($data);
        echo json_encode($resp);
    }
 /**
        * Recibe id del cliente
        * @param  array $clie_id cliente
        * @return array response servicio
    */
    public function habilitarCliente($clie_id = null){
        $data['put_persona'] = array(
            'clie_id' => $clie_id
        );
        $resp= $this->Clientes->habilitarCliente($data);
        echo json_encode($resp);
    }

     /**
        * Recibe id del cliente
        * @param  array $clie_id cliente
        * @return view personas
    */
    public function getPersonas($clie_id = null){

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
        
        return view('Modules\wema\Views\persona\index',$data).view('Modules\wema\Views\clientes\modalGenericoCliente');
    }


    public function getModalCliente(){
        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");

        /* LISTADO TIPO PERSONAS */
        $data['tipoPersona'] = $this->Generales->getTabla("tipos_personas");

        /* LISTADO TIPO CLIENTES */
        $data['tipoCliente'] = $this->Generales->getTabla("tipos_clientes");

        /* LISTADO DE CLIENTES */
        $data['listadoClientes'] = $this->Clientes->getClientes();

        return view('Modules\wema\Views\clientes\modalGenericoCliente',$data);
    }


    public function modalCuenta($empr_id = null){
        /* LISTADO CUENTAS - Adapatar a Cuentas, ahora trae personas */
        $data['empresa'] = $this->Cuentas->getCuentaxId($empr_id);

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

        return view('Modules\wema\Views\cuentas\modalCuenta', $data);
    } 

    /**
        * Recibe id de la empresa
        * @param  array $empr_id empresa
        * @return view clientes
    */
    function getClientesXIdEmpresa($empr_id)
    {
        /* LISTADO DE CLIENTES */
        $resp = $this->Cuentas->getClientes($empr_id);
         
        echo json_encode($resp);
    }
}