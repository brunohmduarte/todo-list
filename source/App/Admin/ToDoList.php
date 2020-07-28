<?php

namespace Source\App\Admin;

use Source\App\Controller;
use Source\App\Helpers\Date;
use Source\App\Helpers\Session;
use Source\Models\Task;
use Source\Models\User;

class ToDoList extends Controller 
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        (new Session())->authenticated();
    }
    
    /**
     * Mosta todos as tarefas do usuário logado.
     *
     * @return void
     */
    public function list() : void
    {
        $user = (new User)->findById($_SESSION['user']['id']);
        $tasks = $user->tasks();
        $data['list'] = [];
        
        if (empty($tasks)) {
            $this->redirect("adm/todo-list/list.html", $data);
            return;
        }

        foreach ($tasks as $task) {
            $task->data()->initial_date_time = Date::convertTimestamp($task->data()->initial_date_time);
            $task->data()->final_date_time = Date::convertTimestamp($task->data()->final_date_time);
            array_push($data['list'], (array) $task->data());
        }

        $this->redirect("adm/todo-list/list.html", $data);
    }
    
    /**
     * Exibe o formulário de cadastro da nova tarefa.
     *
     * @return void
     */
    public function create() : void
    {
        $this->redirect("adm/todo-list/form.html", ["action" => "register"]);
    }
        
    /**
     * Inserir uma tarefa no banco de dados.
     *
     * @param  array $data - Dados vindo do formulário de cadastro.
     * @return void
     */
    public function register(array $data) : void
    {
        list($event, $description, $start_date, $start_time, $closing_date, $closing_time) = array_values($data);
        
        $task = new Task();

        $task->user_id = $_SESSION['user']['id'];
        $task->event = $event;
        $task->description = $description;
        $task->initial_date_time = "{$start_date} {$start_time}";
        $task->final_date_time = "{$closing_date} {$closing_time}";
        
        print json_encode(
            ($task->save()) 
                ? ["success" => "Operação realizado com sucesso!"] 
                : ["error" => "Não foi possível realizar o cadastro!"]
        );
        return;
    }
    
    /**
     * Exibe a tela de formulário para alteração dos dados.
     *
     * @param  mixed $data
     * @return void
     */
    public function update(array $data) : void
    {
        $task = (new Task)->findById($data['id'])->data();

        $initialDate = explode(" ", $task->initial_date_time);
        $finalDate = explode(" ", $task->final_date_time);

        $this->redirect("adm/todo-list/form.html", [
            "action" => "edit",
            "data" => [
                "id" => $task->id,
                "event" => $task->event,
                "description" => $task->description,
                "start_date" => $initialDate[0],
                "start_time" => $initialDate[1],
                "closing_date" => $finalDate[0],
                "closing_time" => $finalDate[1]
            ]
        ]);
    }
    
    /**
     * Altera as informações do registro na base de dados.
     *
     * @param  mixed $data
     * @return void
     */
    public function edit(array $data) : void
    {
        list($id, $event, $description, $start_date, $start_time, $closing_date, $closing_time) = array_values($data);
        
        $task = (new Task)->findById($id);

        $task->user_id = $_SESSION["user"]["id"];
        $task->event = $event;
        $task->description = $description;
        $task->initial_date_time = "{$start_date} {$start_time}";
        $task->final_date_time = "{$closing_date} {$closing_time}";

        print json_encode(
            ($task->save()) 
                ? ["success" => "Operação realizado com sucesso!"] 
                : ["error" => "Não foi possível realizar o cadastro!"]
        );
        return;
    }
    
    /**
     * Remove o registro da base de dados.
     *
     * @param  mixed $data
     * @return void
     */
    public function delete(array $data)
    {
        if ($task = (new Task)->findById($data['id'])) {
            print json_encode(
                ($task->destroy()) 
                    ? ["success" => "Operação realizado com sucesso!"] 
                    : ["error" => "Não foi possível realizar o cadastro!"]
            );
            return;
        }
    }
}
