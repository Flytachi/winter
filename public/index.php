<?php

require '../bootstrap.php';

$router = \Flytachi\Winter\K2\Route\Router::fromScan(\Flytachi\Winter\K2\Kernel::$pathRoot);
$router->static(\Flytachi\Winter\K2\Kernel::$pathPublic);
$router->handle(
    new \Flytachi\Winter\K2\Http\Adapter\FpmRequest(),
    new \Flytachi\Winter\K2\Http\Adapter\FpmResponse(),
);
