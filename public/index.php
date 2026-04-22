<?php

use Flytachi\Winter\K2\Http\Adapter\FpmRequest;
use Flytachi\Winter\K2\Http\Adapter\FpmResponse;
use Flytachi\Winter\K2\Kernel;
use Flytachi\Winter\K2\Route\Router;

require '../bootstrap.php';

/*
    Router — attribute scan
    -----------------------
    Recursively walks Kernel::$pathRoot looking for controller classes annotated
    with #[GetMapping], #[PostMapping], #[PutMapping], #[PatchMapping],
    #[DeleteMapping], or #[RequestMapping] and registers their routes automatically.

    The vendor/ directory is always excluded from the scan.
    Additional directories to skip can be passed as a second argument:

        Router::fromScan(Kernel::$pathRoot, [Kernel::$pathRoot . '/legacy'])

    Also wires up:
      · Plugin routes  — every Plugin::registry() prefix is scanned from its src/
      · Health routes  — if Health::configure() was called in bootstrap.php
      · ExceptionWrapper — discovers custom #[AdviceException] classes for error rendering
*/
$router = Router::fromScan(Kernel::$pathRoot);

/*
    Static file serving  (optional)
    --------------------------------
    Intercepts GET requests whose URI maps to a real file inside $publicDir and
    sends the file directly — skipping route dispatch entirely.

    In FPM+nginx setups nginx already handles static files, so this call is
    a no-op in production if nginx is configured correctly. It is kept here
    so that the built-in PHP dev server (`php -S`) works out of the box without
    extra server configuration.

    Remove or comment out this line if nginx / Apache is serving static assets.

    @param string $publicDir  Absolute path to the web-accessible directory.
*/
$router->static(Kernel::$pathPublic);

/*
    Dispatch — FPM mode
    -------------------
    Reads the current HTTP request from PHP superglobals ($_SERVER, $_GET, $_POST,
    $_FILES, php://input) and writes the response via http_response_code() / header()
    / echo.  One request → one process lifecycle; no shared state between calls.

    For Swoole coroutine mode use the Swoole adapters instead:
        $router->handle(new SwooleRequest($req), new SwooleResponse($res));

    The pipeline executed on every request:
      1. Header::init()       — snapshot superglobals into the static Header bag
      2. Locale::initFromRequest() — detect Accept-Language / locale cookie
      3. Static file check    — short-circuit for existing files (see above)
      4. Global CORS headers  — applied before route dispatch (covers 404 / 500 too)
      5. OPTIONS preflight    — returns 204 and exits before handler invocation
      6. Route dispatch       — static hash-map lookup, then regex dynamic scan
      7. Middleware before()  — run in declaration order
      8. Controller method    — resolved via ReflectionCache + ParameterResolver
      9. Middleware after()   — run in reverse order
     10. Response serialise   — Sendable::send() or ResponseEntity::ok($result)->send()
     11. Error handling       — ExceptionWrapper maps Throwable → HTTP response
*/
$router->handle(
    new FpmRequest(),
    new FpmResponse(),
);
