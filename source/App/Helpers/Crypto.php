<?php

namespace Source\App\Helpers;

class Crypto 
{    
    /**
     * Criptografa uma string em um has de 60 caracteres.
     *
     * @param  mixed $data - Dado a ser criptografado.
     * @return string
     */
    public static function createHash(string $data) : string
    {
        return password_hash($data, PASSWORD_BCRYPT, ["cost" => 12]);
    }
    
    /**
     * Verifica se os hash passado são iguais.
     *
     * @param  mixed $data1 - String sem criptografia para ser comparado.
     * @param  mixed $data2 - String criptografada para ser comparada.
     * @return bool
     */
    public static function checksHash(string $data1, string $data2) : bool
    {
        return password_verify($data1, $data2);
    }
}
