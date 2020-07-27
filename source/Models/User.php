<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Source\App\Helpers\Crypto;
use Source\Models\Task;

class User extends Datalayer
{
        
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct("users", ["first_name", "email", "password"]);
    }
    
    /**
     * Método de vinculação entre modelos "user" e "task".
     *
     * @return void
     */
    public function tasks()
    {
        return (new Task())->find("user_id=:uid", "uid={$this->id}")->fetch(true);
    }
    
    /**
     * Verifica se as credenciais de login do usuário estão corretas.
     *
     * @param  mixed $data - Os dados vindo do formulário.
     * @return bool
     */
    public function authenticateCredentialsUser(array $data) : bool
    {
        $dataUser = $this->find("email=:email", "email={$data['address_email']}")->fetch();

        if (empty($dataUser)) {
            return false;
        }
        
        if (!Crypto::checksHash($data['password'], $dataUser->password)) {
            return false;
        }

        return true;
    }
}
