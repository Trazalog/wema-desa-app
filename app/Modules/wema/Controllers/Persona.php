<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Personas; 


class Persona extends BaseController
{
    public function index()
    {
        $url = REST_PERSONA."/persona";
        $aux = $this->REST->callAPI("GET",$url);

        /* LISTADO PERSONAS */
        $resp = json_decode($aux['data']);
        $data['listadoPersonas'] = $resp->personas->persona;

        /* LISTADO DE GENEROS */
        $url = REST_PERSONA."/generos";
        $aux = $this->REST->callAPI("GET",$url);
        $resp = json_decode($aux['data']);
        $data['listadoGeneros'] = $resp->generos->genero;

        /* LISTADO PAISES */
        $url = REST_PERSONA."/paises";
        $aux = $this->REST->callAPI("GET",$url);
        $resp = json_decode($aux['data']);
        $data['listadoPaises'] = $resp->paises->pais;

        /* LISTADO ESTADO CIVIL */
        $url = REST_PERSONA."/estadocivil";
        $aux = $this->REST->callAPI("GET",$url);
        $resp = json_decode($aux['data']);
        $data['listadoEstadoCivil'] = $resp->estadosciviles->estadocivil;
      
         /* LISTADO ESTADO CIVIL */
         $url = REST_PERSONA."/escolaridad";
         $aux = $this->REST->callAPI("GET",$url);
         $resp = json_decode($aux['data']);
         $data['listadoNivelEducativo'] = $resp->niveles_educativos->nivel_educativo;


        /* $persona = new Personas();
        $resp = $persona->getPersona();  */
        
        //var_dump($data['listadoPaises']);

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

}
