<?php

namespace Source\App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;

class Controller
{
    /**
     * Get an instance of the class \Twig\Environment for load file of template.
     * 
     * @var $view
     */
    public $view;

    public function __construct()
    {
        $this->loadView();
    }

    /**
     * Loads the Twig environment.
     * 
     * @return \Twig\Environment
     */
    public function loadView() : void 
    {
        $this->view = new Environment(new FilesystemLoader("view/"), ["debug" => true, "cache" => false]);
        $this->view->addExtension(new DebugExtension());
    }
    
    /**
     * redirect
     *
     * @param  mixed $fileName
     * @param  mixed $data
     * @return void
     */
    public function redirect(string $fileName, array $data = []) : void
    {
        $data['base_url'] = URL_BASE;
        $data["session_user"] = $_SESSION["user"] ?? "";
        $this->view->display($fileName, $data);
    }
}