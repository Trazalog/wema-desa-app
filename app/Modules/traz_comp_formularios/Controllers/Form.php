<?php
 
namespace Modules\traz_comp_formularios\Controllers; 
use App\Controllers\BaseController;
use Modules\traz_comp_formularios\Models\Forms; 


class Form extends BaseController
{
    public function __construct()
    {
        $this->Forms = new Forms();
    }

    public function obtener($info, $modal = false)
    {

        $html = form($this->Forms->obtener($info), $modal);

        if ($modal) {
            $modal = new StdClass();
            $modal->id = "frm-modal-$info";
            $modal->titulo = 'Formulario Tarea';
            $modal->body = $html;
            $modal->accion = 'Guardar';

            $html = modal($modal);
        }

        $data['html'] = $html;

        echo json_encode($data);
    }
    /**
	* Genera una nueva instancia del form_id enviado
	* @param integer $form_id 
	* @return array instancia formulario generado
	*/
    public function obtenerNuevo($form = ''){
        log_message('info','#TRAZA | TRAZ-COMP-FORMULARIOS | Controller | Form | obtenerNuevo() form_id ->'. $form);

        if(!empty($form)){

            $data['html'] = form($this->Forms->obtenerPlantilla($form));
            echo $data['html'];

        }else{
            echo '<h5>No se especificó un formulario.</h5>';
        }
    }

    public function guardar($info_id = false, $new = false){
        log_message('info',"#TRAZA | #TRAZ_COMP_FORMULARIOS | Controllers | Form | guardar()");

        $data = $this->input->post();
        foreach ($data as $key => $o) {

            $rsp = strpos($key, 'file');
            if ($rsp > 0) {
                $nom = str_replace("-file-", "", $key);
                //Los files se codifican en base64 y se guarda en la tabla directamente en la columna valor4_base64
                // $data[$nom] = $this->uploadFile($key); 
                $data[$nom] = $_FILES[$key]['name'];
                unset($data[$key]);
            }
        }

        if ($new) {
            $res['info_id'] = $this->Forms->guardar($info_id, $data);
        } else {
            $res['info_id'] = $this->Forms->actualizar($info_id, $data);
        }
        echo json_encode($res);
    }

    public function guardarCuestionario($form_id = false){
        log_message('info',"#TRAZA | #TRAZ_COMP_FORMULARIOS | Controllers | Form | guardar()");
        // $request = \Config\Services::request();
        // $data = $this->input->post();
        $audios = $_FILES['audio'];
        // foreach ($data as $key => $o) {

        //     $rsp = strpos($key, 'file');
        //     if ($rsp > 0) {
        //         $nom = str_replace("-file-", "", $key);
        //         //Los files se codifican en base64 y se guarda en la tabla directamente en la columna valor4_base64
        //         // $data[$nom] = $this->uploadFile($key); 
        //         $data[$nom] = $_FILES[$key]['name'];
        //         unset($data[$key]);
        //     }
        // }

        // if ($new) {
            $res['info_id'] = $this->Forms->guardarCuestionario($form_id, $audios);
            $res['status'] = true;
        // } else {
        //     $res['info_id'] = $this->Forms->actualizar($info_id, $data);
        // }
        // echo json_encode($res);
        echo json_encode($res);
    }
}
