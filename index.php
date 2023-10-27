<?php
session_start();
ob_start();

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");

/**
 * Web Routes
 */

$route->namespace("Source\App");
$route->get("/","Web:home");
$route->get("/cadastrar","Web:cadastrar");
$route->get("/login","Web:login");
$route->get("/recuperar","Web:recuperar");


/**
 *  REGISTER LOGIN
 */
$route->get("/cadastrar","Web:cadastrar");
$route->post("/cadastrar","Web:register");

$route->get("/login","Web:login");
$route->post("/login","Web:login");


/**
 * App Routs
 */

$route->group("/app");
$route->get("/","App:home");
$route->get("/perfil","App:perfil");
$route->get("/sair","App:logout");


$route->group(null);
/*
 * Erros Routes
 */

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

/*
 * Error Redirect
 */

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();