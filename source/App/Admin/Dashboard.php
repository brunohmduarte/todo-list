<?php

namespace Source\App\Admin;

use Source\App\Controller;
use Source\App\Helpers\Session;

class Dashboard extends Controller 
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        (new Session())->authenticated();
    }
    
    /**
     * Endpoint da página home.
     *
     * @return void
     */
    public function home() : void
    {
        $this->redirect("adm/dashboard.html");
    }
    
    /**
     * Endpoint de sair da seção administradora.
     *
     * @return void
     */
    public function logout()
    {
        (new Session)->destroy("user");
        header("Location: ". URL_BASE ."signin");
    }
}
