<?php

namespace Source\App;

use Source\App\Helpers\Crypto;
use Source\Models\FormValidation\SignUp;
use Source\Models\User;

class Admin extends Controller
{     
    /**
     * mesageError
     *
     * @var string
     */
    public $mesageError = "Não foi possível realizar o cadastro, verifique se as informações do formulário estão corretas e tente novamente.";
    
    /**
     * Redireciona para a página signin.
     *
     * @return void
     */
    public function signin() : void
    {
        $this->redirect("signin.html");
    }
    
    /**
     * Redireciona para a página signup.
     *
     * @return void
     */
    public function signup() : void
    {
        $this->redirect("signup.html");
    }
    
    /**
     * Registra um novo usuário para utilizar à aplicação.
     *
     * @param  mixed $data - Dados do usuário vindo do formulário de cadastro.
     * @return void
     */    
    public function register(array $data) : void
    {
        if (!(new SignUp)->validateData($data)) {
            print json_encode(["error" => $this->mesageError]);
            return;
        }
        
        list($name, $email, $password) = array_values($data);

        $user = new User();
        $user->first_name = $name;
        $user->email = $email;
        $user->password = Crypto::createHash($password);
        
        if ($user->save()) {
            print json_encode(["success" => "Cadastro realizado com sucesso!"]);
            return;
        }

        print json_encode(["error" => $this->mesageError]);
        return;
    }
}
