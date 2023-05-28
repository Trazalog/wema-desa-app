<?php 

namespace Modules\traz_comp_formularios\Models;

use CodeIgniter\Model;
use App\Libraries\REST;

class Forms extends Model{


    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->REST = new REST();
    }
    /**
        * Guarda la instacia del formulario dinámico
        * @param array datos de formulario
        * @return 
	*/
    public function guardar($form_id, $data = false){   
        $items = $this->obtenerPlantilla($form_id);
        $array = array();
        $aux = array();
        
        foreach ($items->items as $key => $o) {

            unset($o->nombre);
            
            if ($o->name) {
                if(!empty($data[$o->name])){//Valida si no esta vacio, si esta vacio guarda sin valor
                    if(!is_array($data[$o->name])){

                        $o->valor = ($o->tipo_dato == 'radio') ? $data[empresa()."-".$o->name] : $data[$o->name];
                        $o->valor4_base64 = null;
                        
                        
                        if($o->tipo_dato == 'image' || $o->tipo_dato == 'file'){
                            
                            $nom = "-file-".$o->name;
                            
                            if(!empty($_FILES[$nom]['tmp_name'])){
                                $o->valor4_base64 = base64_encode(file_get_contents($_FILES[$nom]['tmp_name']));
                            }
                        }
                        
                        array_push($array, $o);
                    }else{
                        if(!empty($data[$o->name])){
                            foreach ($data[$o->name] as $i => $datos ) {
                                $datoPlantilla = clone $o;

                                $datoPlantilla->valor = $datos;
                                
                                $nom = "-file-".$datoPlantilla->name;
                                
                                if($datoPlantilla->tipo_dato == 'image' || $datoPlantilla->tipo_dato == 'file'){
                
                                    if(!empty($_FILES[$nom]['tmp_name'][$i])){
                                        $datoPlantilla->valor4_base64 = base64_encode(file_get_contents($_FILES[$nom]['tmp_name'][$i]));
                                    }else{
                                        $datoPlantilla->valor4_base64 = NULL;
                                    }
                                    
                                }else{
                                    $datoPlantilla->valor4_base64 = NULL;
                                }

                                array_push($array, $datoPlantilla);
                                unset($datoPlantilla);
                            }

                            unset($o);
                        }else{
                            $o->valor = NULL;
                            $o->valor4_base64 = NULL;
                            array_push($array, $o);
                        }
                    }
                }else{
                    //Si $data no estaba seteada, guardo el valor vacio en la instancia
                    array_push($array, $o);
                }
            } else {
                if(!empty($_FILES[$nom]['tmp_name'])){
                    $o->valor4_base64 = base64_encode(file_get_contents($_FILES[$nom]['tmp_name']));
                }else{
                    $o->valor4_base64 = NULL;
                }
                $o->valor = !empty($data[empresa()."-".$o->valo_id])? $data[empresa()."-".$o->valo_id] : '';
                unset($o->values);
                array_push($aux, $o);
            }
            unset($o);
        }
        $this->db->save_queries = FALSE;// Para que no cachee la query

        // if($aux && !$this->db->insert_batch('frm.instancias_formularios', $aux)) return FALSE;
        $rsp = $this->db->table('frm.instancias_formularios')->insertBatch($array);
        
        $queryInfo = $this->db->query('SELECT MAX(info_id) as info_id FROM frm.instancias_formularios');
        $newInfo = $queryInfo->getResultObject()[0]->info_id;

        // $this->instanciarVariables($form_id, $newInfo); Sin adaptar todavia
        log_message('info',"#TRAZA | #TRAZ_COMP_FORMULARIOS | Model | Forms | guardar() >> info_id generado ". $newInfo);

        return $newInfo;
    }
    /**
        * Actualiza la instacia del formulario dinámico enviada por parámetro
        * NOTA: divide la cadena por el caracter '-' ya que los valores pueden venir anidados con la empresa
        * @param array datos de formulario
        * @return $info_id
	*/
    public function actualizar($info_id, $data){
        foreach ($data as $key => $o) {
            if(!$key) continue;
            $this->db->where('info_id', $info_id);
            if(!strpos($key,'-')){
                $this->db->where('name', $key);
            }else{
                $aux = explode('-',$key);
                $this->db->where('name', array_pop($aux));
            }
            $this->db->set('valor', $o);
            if(!empty($_FILES["-file-".$key]['tmp_name'])){
                $valor4_base64 = base64_encode(file_get_contents($_FILES["-file-".$key]['tmp_name']));
                $this->db->set('valor4_base64',$valor4_base64);
            }
            $this->db->update('frm.instancias_formularios');
        }
        log_message('DEBUG',"#TRAZA | #TRAZ_COMP_FORMULARIOS | Model | Forms | actualizar() >> info_id actualizado: ". $info_id);
        return $info_id;
    }
    /**
        * Obtiene uns instacia generada a traves del info_id 
        * @param integer $info_id instancia generada
        * @return array instancia formulario dinamico
	*/
    public function obtener($info_id){
        log_message('info', '#TRAZA | TRAZ-COMP-FORMULARIOS | Model | Forms | obtener($info_id) -> info_id: '.$info_id);

        $query = $this->db->query("select name, label,valor, requerido, valo_id, orden, A.inst_id, A.form_id, tipo_dato, C.nombre, A.valor4_base64, A.columna, A.multiple
            from frm.instancias_formularios as A
            join frm.formularios as C on C.form_id = A.form_id
            where A.info_id = cast($info_id as integer) and A.eliminado = false
            order by A.orden"
        );
        $items = $query->getResultObject();

        $aux = new \StdClass();
        $aux->info_id = $info_id;
        $aux->nombre = count($items) > 0 ? $items[0]->nombre : 'SIN RESULTADOS';//Nombre del formulario
        $aux->id = $info_id;
        $aux->items = $items;

        foreach ($aux->items as $key => $o) {

            if ($o->tipo_dato == 'radio' || $o->tipo_dato == 'check' || $o->tipo_dato == 'select') {

                $aux->items[$key]->values = $this->obtenerValores($o->valo_id);

            }
        }

        return $aux;
    }
    /**
        * Obtiene la plantilla del formulario creada en frm.items a traves del form_id de frm.formularios
        * @param integer $id form_id
        * @return array $aux formulario definido
	*/
    public function obtenerPlantilla($form_id){
        log_message('info', '#TRAZA | TRAZ-COMP-FORMULARIOS | Model | Forms | obtenerPlantilla($form_id) -> form_id: '.$form_id);

        $query = $this->db->query("select name, label, requerido, valo_id, orden, A.form_id, tipo_dato, C.nombre, A.columna, A.multiple
            from frm.items as A
            join frm.formularios as C on C.form_id = A.form_id
            where A.form_id = cast($form_id as integer) and A.eliminado = false
            order by A.orden"
        );
        $items = $query->getResultObject();
        
        $aux = new \StdClass();
        $aux->info_id = false;
        $aux->form_id = $form_id;
        $aux->nombre = count($items) > 0 ? $items[0]->nombre : 'SIN RESULTADOS';//Nombre del formulario
        $aux->id = rand(0,10000);
        $aux->items = $items;

        foreach ($aux->items as $key => $o) {

            if ($o->tipo_dato == 'radio' || $o->tipo_dato == 'check' || $o->tipo_dato == 'select') {

                $aux->items[$key]->values = $this->obtenerValores($o->valo_id);

            }
        }

        return $aux;
    }

    /**
        * Obtengo los valores almacenados en core.tablas para cargar las listas de valores
        * @param id nombre columna tabla
        * @return array valores coincidentes
	*/
    public function obtenerValores($id){
        $this->db->select('tabl_id as value, descripcion as label,valor,eliminado,tabla');
        return $this->db->get_where('core.tablas', array('tabla' => empresa()."-".$id, 'eliminado' => 'false'))->result();
    }

    public function listado()
    {
        $this->db->select('B.nombre, A.form_id, A.info_id');
        $this->db->from('frm.instancias_formularios as A');
        $this->db->join('frm.formularios as B', 'B.form_id = A.form_id');
        $this->db->group_by('info_id, A.form_id, B.nombre');
        return $this->db->get()->result();
    }

    public function instanciarVariables($form_id, $info_id)
    {
        $this->db->select("name, variable, $info_id as info_id");
        $this->db->where('name is not null');
        $this->db->where('form_id', $form_id);
        $res = $this->db->get('frm.items')->result();
        
        foreach ($res as $o) {
            $this->db->where('info_id', $o->info_id);
            $this->db->where('name', $o->name);
            $this->db->set('variable', $o->variable);
            $this->db->update('frm.instancias_formularios');
        }
    }
    public function obtenerXEmpresa($nombre, $emprId)
    {
        $this->db->where('empr_id', $emprId);
        $this->db->where('nombre', $nombre);
        $res = $this->db->get('frm.formularios')->first_row();
        if($res){ 
            return $this->obtenerPlantilla($res->form_id);
        }
    }

    function listarFormularios()
    {
        log_message('DEBUG', 'Formularios/getFormularios');
        $resource = '/formularios/'.empresa();
        $url = REST_FRM . $resource;
        $array = $this->rest->callApi('GET', $url);
        return json_decode($array['data']);
    }
    /**
        * Guarda la instacia del formulario dinámico
        * @param array datos de formulario
        * @return 
	*/
    public function guardarCuestionario($form_id, $audios = false){   
        $items = $this->obtenerPlantilla($form_id);
        $array = array();
        // $aux = array();
        
        foreach ($items->items as $key => $o) {
            unset($o->nombre);//Lo desetea en el objeto $items->items tambien
            if ($o->name) {
                if(!is_array($audios)){

                    $o->valor4_base64 = null;

                    if($o->tipo_dato == 'image' || $o->tipo_dato == 'file'){
                        $nom = "-file-".$o->name;
                        if(!empty($_FILES[$nom]['tmp_name'])){
                            $o->valor4_base64 = base64_encode(file_get_contents($_FILES[$nom]['tmp_name']));
                        }
                    }
                    if($o->tipo_dato == 'question'){
                        if(!empty($_FILES['audio']['tmp_name'])){
                            $o->valor4_base64 = base64_encode(file_get_contents($_FILES['audio']['tmp_name']));
                        }
                    }
                    
                    array_push($array, $o);
                }else{
                    foreach ($audios['name'] as $i => $audio) {
                        $datoPlantilla = clone $o;

                        $datoPlantilla->valor = $_FILES[$datoPlantilla->name]['name'][$i].".wav";//.$_FILES[$datoPlantilla->name]['type'][$i]; Harcodeada
                                    
                        if(!empty($_FILES[$datoPlantilla->name]['tmp_name'][$i])){
                            $datoPlantilla->valor4_base64 = base64_encode(file_get_contents($_FILES[$datoPlantilla->name]['tmp_name'][$i]));
                        }else{
                            $datoPlantilla->valor4_base64 = NULL;
                        }

                        array_push($array, $datoPlantilla);
                        unset($datoPlantilla);
                    }

                    unset($o);
                }
            }else{
                array_push($array, $o);
            }
            unset($o);
        }

        $this->db->table('frm.instancias_formularios')->insertBatch($array);
        $queryInfo = $this->db->query('SELECT MAX(info_id) as info_id FROM frm.instancias_formularios');
        $newInfo = $queryInfo->getResultObject()[0]->info_id;
        log_message('info',"#TRAZA | #TRAZ-COMP-FORMULARIOS | Model | Forms | guardar() >> info_id generado ". $newInfo);

        return $newInfo;
    }
    /**
        * Creo y guardo una instancia vacia del formulario
        * @param integer $form_id
        * @return array $info_id generado
	*/
    public function generarInstancia($form_id){
        $res = $this->guardar($form_id);
        return $res;
    }
    /**
        * Acutaliza un record de la instancia del formulario dinámico
        * @param array $data audio grabado
        * @return array respuesta del procedimiento
	*/
    public function actualizarCuestionario($info_id, $data){
        if(empty($data)) return array('info_id' => $info_id, "status" => false, "msg" => "No se actualizo nada, data estaba vacio");
        
        if(!empty($data['tmp_name'])){
            $datos['valor4_base64'] = base64_encode(file_get_contents($data['tmp_name']));
            $this->db->table('frm.instancias_formularios')
                    ->where('info_id', $info_id)
                    ->like('name',$data['name'])
                    ->update($datos);
            }
        log_message('info',"#TRAZA | #TRAZ_COMP_FORMULARIOS | Model | Forms | actualizar() >> info_id actualizado: ". $info_id);
        return array('info_id' => $info_id, "status" => true, "msg" => "Record guardado correctamente.");
    }
}
