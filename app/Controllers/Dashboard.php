<?php

namespace App\Controllers;
use App\Modules\wema\Controllers\Persona;

class Dashboard extends BaseController
{
    private $persona;

    /**
     * Constructor.
     */
   /*  public function __construct()
    {
        $this->persona = new persona();
    }
 */
    public function index()
    {
      /*   $persona = new Persona();
        $persona->index();  */
       return view('dashboard/index');

    }
}
