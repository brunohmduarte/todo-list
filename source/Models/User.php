<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

use Source\Models\Task;

class User extends Datalayer
{
    public function __construct()
    {
        parent::__construct("users", ["first_name", "last_name", "email", "password"]);
    }

    public function tasks()
    {
        return (new Task())->find("user_id=:uid", "uid={$this->id}")->fetch(true);
    }

    public function authenticateCredentialsUser(array $data) : bool
    {
        $user = $this->find("email=:email AND password=:psword", "email={$data['address_email']}&psword={$data['password']}")
                ->fetch(true);

        return !empty($user);
    }
}
