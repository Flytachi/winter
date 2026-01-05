<?php

namespace Main;

use Flytachi\Winter\Kernel\Stereotype\Output\Response;
use Flytachi\Winter\Kernel\Stereotype\RestController;
use Flytachi\Winter\Mapping\Annotation\RequestMapping;
use Flytachi\Winter\Thread\Signal;

class MainController extends RestController
{
    #[RequestMapping]
    public function hello(): Response
    {
        return new Response('Hello');
    }
}
