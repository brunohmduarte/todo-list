<?php

namespace Source\App;

use Source\App\Helpers\Session;
use Source\Models\User;

class Authentication extends Controller 
{    
    /**
     * Endpoint da rota de autenticação do usuário.
     *
     * @param  mixed $data - Os dados do usuário vindo do formulário de login.
     * @return void
     */
    public function authenticate(array $data) : void
    {
        $user = new User();
        if (empty($data) || !$user->authenticateCredentialsUser($data)) {
            print json_encode(["error" => "Usuário não autenticado!"]);
            return;
        }

        $dataUser = $user->find("email=:email", "email={$data['address_email']}")->fetch();
        
        list($id, $firstName, $lastName, $genre, $email) = array_values((array) $dataUser->data());
        
        (new Session)->start("user", [
            "id" => $id, 
            "first_name" => $firstName,
            "last_name" => $lastName,
            "genre" => $genre, 
            "email" => $email
        ]);

        print json_encode(["success" => "Usuário autenticado!"]);
        return;
    }
}
