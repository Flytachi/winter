<?php

declare(strict_types=1);

use Flytachi\Winter\Kernel\App\Attribute\EnableWeb;
use Flytachi\Winter\Kernel\WinterApplication;

require __DIR__ . '/vendor/autoload.php';

#[EnableWeb]
final class Application extends WinterApplication
{
    public static function main(array $argv): never
    {
        parent::run($argv);
    }
}
