<?php

namespace Source\App;

use Source\Models\User;

class Admin extends Controller
{
    public function login() : void
    {
        $this->redirect("signin.php");
    }

    public function register() : void
    {
        $this->redirect("register.php");
    }
}
