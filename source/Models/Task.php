<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Task extends DataLayer 
{
    public function __construct()
    {
        parent::__construct("tasks", ["user_id", "event", "initial_date_time", "final_date_time"]);
    }

    public function add(User $user, array $data)
    {
        $this->user_id = $data['user_id'];
        $this->event = $data['event'];
        $this->description = $data['description'];
        $this->initial_date_time = $data['initial_date_time'];
        $this->final_date_time = $data['final_date_time'];
        $this->status = $data['status'];

        // $this->save();
        return $this;
    }
}
