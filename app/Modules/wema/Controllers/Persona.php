<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Personas; 
use Modules\wema\Models\Generales; 


class Persona extends BaseController
{
    public function __construct()
    {
        $this->Personas = new Personas();
        $this->Generales = new Generales();
    }

    public function index(){

        /* LISTADO PERSONAS */
        $data['listadoPersonas'] = $this->Personas->getPersonas();

        /* LISTADO DE GENEROS */
        $data['listadoGeneros'] = $this->Generales->getTabla("generos");

        /* LISTADO PAISES */
        $data['listadoPaises'] = $this->Generales->getTabla("paises");

        /* LISTADO ESTADO CIVIL */
        $data['listadoEstadoCivil'] = $this->Generales->getTabla("estados_civiles");
      
        /* LISTADO NIVELES EDUCATIVOS */
        $data['listadoNivelEducativo'] = $this->Generales->getTabla("niveles_educativos");

        return view('Modules\wema\Views\persona\index',$data);
    }


    public function guardarPersona(){

        $request = \Config\Services::request();

        $url = REST_PERSONA."/persona";
        
        $data['post_persona'] = array(
            
            'apellidos' => $request->getPost('apellidos'),
            'nombres' => $request->getPost('nombres'),
            'curp' => $request->getPost('curp'),
            'fec_nacimiento' => $request->getPost('fechaNacimiento'),
            'ocupacion'=>  $request->getPost('ocupacion'),
            'telefono' =>  $request->getPost('telefono'),
            'email' =>  $request->getPost('correo'),
            'calle' =>  $request->getPost('calle'),
            'num_exterior' =>  $request->getPost('numeroExterior'),
            'cod_postal' =>  $request->getPost('CodigoColonia'),
            'num_interior' => $request->getPost('numeroInterior'),
            'usr_app_alta' =>   '',
            'usr_app_ult_modif' =>   '',
            'gene_id' =>  $request->getPost('genero'),
            'pana_id' =>  $request->getPost('paisNacimiento'),
            'esci_id' =>  $request->getPost('estadoCivil'),
            'naci_id' =>  $request->getPost('nacionalidad'),
            'educ_id' =>  $request->getPost('escolaridad'),
            'ubic_id' =>  $request->getPost('nacionalidad'),
            'clie_id' =>  "3",
            'imagen' => "", 
        );

        $aux = $this->REST->callAPI("POST",$url, $data);
        

        if($aux['status']){
            return json_encode($aux);
        } 
       else return $aux;

    }

    public function editarPersona(){
        $request = \Config\Services::request();

        $url = REST_PERSONA."/persona";
        
        $data['put_persona'] = array(
            'pers_id'=> $request->getPost('pers_id'),
            'apellidos' => $request->getPost('apellidos'),
            'nombres' => $request->getPost('nombres'),
            'curp' => $request->getPost('curp'),
            'fec_nacimiento' => $request->getPost('fechaNacimiento'),
            'ocupacion'=>  $request->getPost('ocupacion'),
            'telefono' =>  $request->getPost('telefono'),
            'email' =>  $request->getPost('correo'),
            'calle' =>  $request->getPost('calle'),
            'num_exterior' =>  $request->getPost('numeroExterior'),
            'cod_postal' =>  $request->getPost('CodigoColonia'),
            'num_interior' => $request->getPost('numeroInterior'),
            'usr_app_alta' =>   'koke',
            'usr_app_ult_modif' =>   'koke',
            'gene_id' =>  $request->getPost('genero'),
            'pana_id' =>  $request->getPost('paisNacimiento'),
            'esci_id' =>  $request->getPost('estadoCivil'),
            'naci_id' =>  $request->getPost('nacionalidad'),
            'educ_id' =>  $request->getPost('escolaridad'),
            'ubic_id' =>  $request->getPost('nacionalidad'),
            'clie_id' =>  "3",
            'imagen' => "", 
        );

        $aux = $this->REST->callAPI("PUT",$url, $data);
        

        if($aux['status']){
            return json_encode($aux);
        } 
       else return $aux;

}

public function eliminarPersona($pers_id = null){

    $url = REST_PERSONA."/persona";

    $data['delete_persona'] = array(
        'pers_id' => $pers_id
    );
    
    $aux = $this->REST->callAPI("DELETE",$url, $data);

    if($aux['status']){
        return json_encode($aux);
    } 
   else return $aux;
}


public function habilitarPersona($pers_id = null){
    $url = REST_PERSONA."/habilitarpersona";

    $data['put_persona'] = array(
        'pers_id' => $pers_id
    );
    
    $aux = $this->REST->callAPI("PUT",$url, $data);

    if($aux['status']){
        return json_encode($aux);
    } 
   else return $aux;
}
    
}
