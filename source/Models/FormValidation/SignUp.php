<?php

namespace Source\Models\FormValidation;

class SignUp 
{     
    /**
     * rules
     *
     * @var array
     */
    public $rules = [
        "name" => FILTER_SANITIZE_STRING,
        "address_email" => FILTER_VALIDATE_EMAIL,
        "password" => FILTER_SANITIZE_STRING,
        "confirm_password" => FILTER_SANITIZE_STRING 
    ];

    /**
     * Valida os campos do formulário.
     *
     * @param  mixed $data - Dados do usuário vindo do formulário.
     * @return bool
     */
    public function validateData(array $data) : bool
    {
        $newUser = filter_var_array($data, $this->rules);        
        list($name, $email, $password, $confirm_password) = array_values($newUser);
        return !(empty($name) || empty($email) || empty($password) || $password != $confirm_password);
    }
}
