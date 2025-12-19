<?php

require '../bootstrap.php';

//\Flytachi\Kernel\Src\Http\Header::initHeaders([
//    'Accept-CH' => 'Sec-CH-UA, Sec-CH-UA-Mobile, Sec-CH-UA-Platform',
//    'Critical-CH' => 'Sec-CH-UA, Sec-CH-UA-Mobile, Sec-CH-UA-Platform',
//    'Permissions-Policy' => 'ch-ua=(self), ch-ua-mobile=(self), ch-ua-platform=(self)'
//]);
\Flytachi\Winter\Kernel\Actuator::use(
//    new \Flytachi\Winter\Kernel\Http\Health\Health(), // health check endpoints
    new \Flytachi\Winter\Kernel\Http\Router()
);
