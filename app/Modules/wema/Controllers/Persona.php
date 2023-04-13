<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;

class Persona extends BaseController
{
    public function index()
    {
        return view('Modules\wema\Views\persona\index');
    }
}
