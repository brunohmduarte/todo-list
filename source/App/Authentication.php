<?php

namespace Source\App;

use Source\App\Helpers\Session;
use Source\Models\User;

class Authentication extends Controller 
{
    public function authenticate(array $data)
    {
        /**
         * 1. Validar o parâmetro - ok
         * 2. Tratar os dados
         * 3. Autenticar as credenciais - ok
         * 4. Criar a seção quando o usuario for autenticado - 
         * 5. Redirecionar para área administrativa
         * 6. Retornar uma retorna uma mensagem de usuario não autenticado
         */
        $user = new User();
        if (empty($data) || !$user->authenticateCredentialsUser($data)) {
            print json_encode(["error" => "Usuário não autenticado!"]);
            return;
        }

        $dataUser = $user->find("email=:email AND password=:psword", "email={$data['address_email']}&psword={$data['password']}")->fetch();
        /**
         * @todo pensar um geito melhor de criar esse array de user.
         */
        (new Session)->start("user", [
            "id" => $dataUser->data()->id, 
            "first_name" => $dataUser->data()->first_name,
            "last_name" => $dataUser->data()->last_name,
            "genre" => $dataUser->data()->genre, 
            "email" => $dataUser->data()->email
        ]);
        
        print json_encode(["success" => "Usuário autenticado!"]);
        return;
    }
}
