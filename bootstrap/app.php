<?php

declare(strict_types=1);

use App\Http\Middleware\ForceJsonResponse;
use App\Shared\Response\JsonResp;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(ForceJsonResponse::class);
        $middleware->statefulApi();
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            $message = $e->getMessage();

            if (str_contains($message, 'route')) {
                return JsonResp::routeNotFound();
            }

            if (str_contains($message, 'model')) {
                return JsonResp::resourceNotFound();
            }

            return false;
        });

        $exceptions->renderable(function (AccessDeniedHttpException $e, Request $request) {
            return JsonResp::unauthorized();
        });
    })->create();
