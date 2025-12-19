<?php

namespace Main;

use Flytachi\Winter\Kernel\Stereotype\Output\Response;
use Flytachi\Winter\Kernel\Stereotype\RestController;
use Flytachi\Winter\Mapping\Annotation\RequestMapping;

class MainController extends RestController
{
    #[RequestMapping]
    public function hello(): Response
    {
        return new Response("hello");
    }
}
