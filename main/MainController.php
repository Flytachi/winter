<?php

namespace Main;

use Flytachi\Winter\K2\Http\Response\ResponseEntity;
use Flytachi\Winter\K2\Route\Annotation\RequestMapping;
use Flytachi\Winter\K2\Stereotype\Controller;

class MainController extends Controller
{
    #[RequestMapping]
    public function hello(): ResponseEntity
    {
        return ResponseEntity::ok('Hello');
    }
}
