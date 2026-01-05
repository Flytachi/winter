<?php

namespace Main;

use Flytachi\Winter\Kernel\Stereotype\RestController;
use Flytachi\Winter\Mapping\Annotation\RequestMapping;
use Flytachi\Winter\Thread\Signal;

class MainController extends RestController
{
    #[RequestMapping]
    public function hello(): void
    {
//        $id = TestJob::dispatch();
//        dd(Signal::interrupt($id));
//        TestJob::dispatch(['greeting' => 'Hello World!']);
//        $id = TestProcess::dispatch(['greeting' => 'Hello World!']);

//        sleep(5);
//        Signal::interrupt($id);
        dd(TestDaemon::stop());
    }
}
