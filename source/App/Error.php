<?php

namespace Source\App;

use Source\App\Controller;

class Error extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Exibe a página de erro.
     *
     * @param  mixed $data - Informações do erro.
     * @return void
     */
    public function show(array $data) : void
    {
        $data['description'] = $this->definitionErrorTitle($data["errcode"]);
        $this->redirect("error.html", $data);
    }

    public function definitionErrorTitle(string $erro)
    {
        if (empty($erro)) {
            return $erro;
        }

        if ($erro == "400") {
            return "Não podemos atender a sua requisição no momento.";
        }

        if ($erro == "404") {
            return "A página que você está tentando acessar não existe.";
        }

        if ($erro == "405") {
            return "O método de requisição HTTP que você está acessando, não é suportado nessa aplicação.";
        }

        if ($erro == "501") {
            return "Não suportamos a funcionalidade requerida para completar a sua requisição.";
        }
    }
}
