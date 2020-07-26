<?php

namespace Source\App\Helpers;

class Session 
{    
    /**
     * Obtém as informações da seção existente.
     * 
     * @param string $name O nome da seção a qual deseja obtér as informações.
     * @return array
     */
    public function get(string $name = "") : array
    {
        return (empty($name)) ? $_SESSION : $_SESSION[$name];
    }

    /**
     * Cria uma nova sessão.
     * 
     * @param string $name Nome da nova seção.
     * @param array $data Os dados que esta nova seção possui.
     * @return bool
     */
    public function start(string $name, array $data = []) : void
    {
        if (empty($name)) {
            return;
        }
        
        $_SESSION[$name] = $data;
    }
    
    /**
     * Destroi uma seção específica ou todas as sessões.
     * 
     * @param string $sessionName O nome da seção que deseja destruir.
     * @return bool
     */
    public function destroy(string $sessionName = "") : void 
    {
        if (empty($sessionName)) {
            return;
        }
        if (!empty($sessionName)) {
            unset($_SESSION[$sessionName]);
            return;
        }
        unset($_SESSION);
        return;
    }

    public function authenticated() : void
    {
        if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
            header('Location: ' . URL_BASE .'login');
        }
    }
}