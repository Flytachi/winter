<?php

namespace Tests;

use Flytachi\Winter\Kernel\Kernel;
use PHPUnit\Framework\TestCase;

class DefaultUnitTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        Kernel::init();
    }

    public function testDirectories()
    {
        $this->assertTrue(is_dir(Kernel::$pathRoot));
        $this->assertTrue(is_dir(Kernel::$pathPublic));
        $this->assertTrue(is_dir(Kernel::$pathStorage));
    }

    public function testMapping()
    {
        $router = new \Flytachi\Winter\Kernel\Http\Router();
        $router->generateMappingRoutes();
        $this->assertTrue(is_file($router->getPathMapping()));
    }
}
