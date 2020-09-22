<?php

require dirname(__DIR__, 2) . "/vendor/autoload.php";

use ISWEB\Router\Router;

define("BASE", "https://www.localhost/router/exemple/controller");
$router = new Router(BASE);

/**
 * routes
 */
$router->namespace("Test");

$router->get("/", "Page:home");
$router->get("/edit/{id}", "Page:edit");
$router->post("/edit/{id}", "Page:edit");

/**
 * group by routes and namespace
 */
$router->group("admin");

$router->get("/", "Page:admin");
$router->get("/user/{id}", "Page:admin");
$router->get("/user/{id}/profile", "Page:admin");
$router->get("/user/{id}/profile/{photo}", "Page:admin");

/**
 * named routes
 */
$router->group("name");
$router->get("/", "Name:home", "name.home");
$router->get("/hello", "Name:hello", "name.hello");

$router->get("/redirect", "Name:redirect", "name.redirect");
$router->get("/redirect/{category}/{page}", "Name:redirect", "name.redirect");
$router->get("/params/{category}/page/{page}", "Name:params", "name.params");

/**
 * Group Error
 */
$router->group("error")->namespace("Test");
$router->get("/{errcode}", "Page:notFound");

/**
 * execute
 */
$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
    //router->redirect("/error/{$router->error()}");
}