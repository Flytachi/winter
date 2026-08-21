<?php

namespace Main;

use Flytachi\Winter\Kernel\Http\Response\ResponseEntity;
use Flytachi\Winter\Kernel\Http\Stereotype\Controller;
use Flytachi\Winter\Kernel\Route\Annotation\RequestMapping;

class MainController extends Controller
{
    #[RequestMapping]
    public function hello(): ResponseEntity
    {
        return ResponseEntity::ok('Hello');
    }
}
