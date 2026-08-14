<?php

namespace Main;

use Flytachi\Winter\K2\Route\Annotation\RequestMapping;
use Flytachi\Winter\Kernel\Http\Response\ResponseEntity;
use Flytachi\Winter\Kernel\Http\Stereotype\Controller;

class MainController extends Controller
{
    #[RequestMapping]
    public function hello(): ResponseEntity
    {
        return ResponseEntity::ok('Hello');
    }
}
