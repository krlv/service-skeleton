<?php

namespace Skeleton\App\Middleware;

use Monolog\Logger;
use Slim\Http\Request;
use Slim\Http\Response;

class LoggerMiddleware
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Request $request, Response $response, callable $next) {
        $route = $request->getAttribute('route');

        // Sample log message
        $this->logger->info("dispatching '{$route->getPattern ()}' route");

        return $next($request, $response);
    }
}