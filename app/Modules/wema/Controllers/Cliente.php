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

        /* LISTADO TIPO CLIENTES */
        $data['tipoCliente'] = $this->Generales->getTabla("tipos_clientes");

        /* LISTADO DE CLIENTES */
        $data['listadoClientes'] = $this->Clientes->getClientes();
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cliente | Index | Cliente:  ".json_encode($data['listadoClientes'],true));
        log_message('debug', "#TRAZA | WEMA-DESA-APP | Cliente | Index | ORGB:  ".json_encode($data['listadoClientes']));

        return view('Modules\wema\Views\clientes\index', $data);
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
            'empr_id' =>  '1',
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
            'empr_id' =>  '1',
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
}