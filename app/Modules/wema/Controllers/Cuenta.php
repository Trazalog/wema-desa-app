<?php
 
namespace Modules\wema\Controllers; 
use App\Controllers\BaseController;
use Modules\wema\Models\Cuentas; 


class Cuenta extends BaseController
{
    public function index()
    {
            return view('Modules\wema\Views\cuentas\index');
    }
}