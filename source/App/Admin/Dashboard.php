<?php

namespace Source\App\Admin;

use Source\App\Controller;
use Source\App\Helpers\Session;

class Dashboard extends Controller 
{
    public function __construct()
    {
        parent::__construct();
        (new Session())->authenticated();
    }

    public function home() : void
    {
        $this->redirect("adm/dashboard.html");
    }

    public function logout()
    {
        (new Session)->destroy("user");
        header("Location: ". URL_BASE ."login");
    }
}
