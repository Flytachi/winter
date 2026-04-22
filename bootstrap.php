<?php

declare(strict_types=1);

use Flytachi\Winter\K2\Http\Cors;
use Flytachi\Winter\K2\Http\Health\Health;
use Flytachi\Winter\K2\Kernel;
use Flytachi\Winter\K2\Plugin;

/*
    Autoload
    --------
    Loads all Composer-managed dependencies and framework classes.
*/
require __DIR__ . '/vendor/autoload.php';

/*
    Kernel
    ------
    Bootstraps the framework: resolves paths, loads .env, configures
    logging, timezone, error reporting and thread runner.

    All parameters are optional — omitted ones are derived from $pathRoot.

    @param string|null $pathRoot            Project root directory           (default: auto-detected)
    @param string|null $pathEnv             .env file location               (default: $pathRoot/.env)
    @param string|null $pathPublic          Web-accessible public directory  (default: $pathRoot/public)
    @param string|null $pathResource        View / template resources        (default: $pathRoot/resources)
    @param string|null $pathStorage         Writable storage root            (default: $pathRoot/storage)
    @param string|null $pathStorageLog      Log files directory              (default: $pathStorage/logs)
    @param string|null $pathStorageCache    Cache files directory            (default: $pathStorage/cache)
    @param string|null $pathStorageRunnable Runnable task files              (default: $pathStorage/runnable)
    @param bool        $isTmpVolatile       Volatile in sys_get_temp_dir()   (default: true)
    @param LoggerInterface|null $logger     Custom PSR-3 logger              (default: auto from .env)

    ── Logging (.env variables) ────────────────────────────────────────────────

    All logging is configured via .env — no code changes needed.

    LOGGER_LEVEL_ALLOW=DEBUG,INFO,WARNING,ERROR
        Comma-separated list of log levels to enable.
        Available: DEBUG | INFO | NOTICE | WARNING | ERROR | CRITICAL | ALERT | EMERGENCY
        Empty value disables logging entirely.

    LOGGER_SYSLOG=true
        Force output to syslog. Auto-enabled when running inside Docker
        (detected by presence of /.dockerenv).

    LOGGER_FILE_MAX=7
        Number of rotating daily log files to keep in $pathStorageLog.
        Set to 0 to disable file logging.

    LOGGER_LINE_DATE_FORMAT=Y-m-d H:i:s P
        Timestamp format for each log line (PHP date() format).

    LOGGER_FILE_DATE_FORMAT=Y-m-d
        Date suffix appended to rotating log filenames, e.g. app-2024-01-15.log
*/
Kernel::init();

/*
    CORS  (optional)
    ----------------
    Global Cross-Origin policy applied to every response, including 404 / 500.
    Per-route overrides are available via the #[CrossOrigin] attribute on any
    controller class or method — method-level takes priority over class-level.

    @param string[] $origins        Allowed origins. Empty array → wildcard '*'.
    @param string[] $allowHeaders   Headers allowed in preflight.
    @param string[] $exposeHeaders  Headers exposed to the browser.
    @param bool     $credentials    Send Access-Control-Allow-Credentials.
    @param int      $maxAge         Preflight cache lifetime in seconds.

    Cors::configure(
        origins:       ['https://app.example.com', 'https://admin.example.com'],
        allowHeaders:  ['Content-Type', 'Authorization', 'X-Request-Id'],
        exposeHeaders: ['X-Request-Id'],
        credentials:   true,
        maxAge:        3600,
    );
*/
//Cors::configure();

/*
    Health / Actuator  (optional)
    ------------------------------
    Registers read-only diagnostic endpoints under /actuator.
    All endpoints return JSON. Useful for load-balancer probes and monitoring.

    Endpoints (GET):
        /actuator            — full report (aggregates all methods below)
        /actuator/health     — overall status: up | degraded | down
                               checks DB ping, Redis ping, disk usage, memory usage
                               degraded: ≥80% usage  |  down: ≥90% usage or connection failed
        /actuator/info       — PHP version, SAPI, framework version, project meta
        /actuator/metrics    — CPU load, memory, disk, opcache stats, request info, uptime
        /actuator/env        — custom env values (override env() in your indicator)
        /actuator/loggers    — active log levels from LOGGER_LEVEL_ALLOW
        /actuator/mappings   — registered route table

    @param string      $indicator  Class implementing HealthIndicatorInterface (default: built-in).
    @param string|null $middleware Middleware class to guard all /actuator/* endpoints.

    Default (built-in indicator, open access):
        Health::configure();

    Custom indicator — extend HealthIndicator or implement HealthIndicatorInterface:
        Health::configure(indicator: App\Health\AppHealthIndicator::class);

    With middleware guard (e.g. require internal API key):
        Health::configure(
            indicator:  App\Health\AppHealthIndicator::class,
            middleware: App\Http\Middleware\InternalOnlyMiddleware::class,
        );
*/
//Health::configure();

/*
    Plugins  (optional)
    -------------------
    Registers Composer packages as route-prefixed sub-applications.
    Each plugin's src/ directory is scanned for controllers automatically
    by Router::fromScan() — no extra wiring required.

    @param string $package  Composer package name  (e.g. 'acme/billing').
    @param string $prefix   URL prefix             (e.g. '/billing').
    @param bool   $required Throw if package is not installed (default: true).

    Plugin::registry('acme/auth-plugin',    '/auth');
    Plugin::registry('acme/billing-plugin', '/billing');
*/
//Plugin::registry('', '');