<?php

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

/**
 * Controllers
 */
$router->namespace("Source\App");

/**
 * Section SignIn
 */
$router->group(null);
$router->post("/authenticate", "Authentication:authenticate");
$router->post("/register", "Admin:register");
$router->get("/signup", "Admin:signup");
$router->get("/signin", "Admin:signin");
$router->get("/", "Admin:signin");

/**
 * Errors
 */
$router->group("error");
$router->get("/{errcode}", "Error:show");

/**
 * Section Admin
 */
$router->namespace("Source\App\Admin")->group("admin");
$router->get("/", "Dashboard:home");
$router->get("/logout", "Dashboard:logout");

$router->post("/task/register", "ToDoList:register");
$router->post("/task/edit", "ToDoList:edit");
$router->get("/task/{id}/edit", "ToDoList:update");
$router->get("/task/{id}/remove", "ToDoList:delete");
$router->get("/task/new", "ToDoList:create");
$router->get("/tasks", "ToDoList:list");

/**
 * This method executes the routes
 */
$router->dispatch();

/*
 * Redirect all errors
 */
if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}