<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Exceptions\BadRequestException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Reflector;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use ReflectionParameter;

final class SubstituteUuids
{
    /**
     * @throws BadRequestException
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route();

        /** @var ReflectionParameter[] $parameters */
        $parameters = array_filter($route->signatureParameters(), function ($p) {
            return Reflector::getParameterClassName($p) === UuidInterface::class;
        });

        foreach ($parameters as $parameter) {
            $parameterValue = $route->parameter($parameter->getName());

            try {
                $parameterUuidValue = Uuid::fromString($parameterValue);
            } catch (InvalidUuidStringException) {
                throw new BadRequestException('Invalid uuid');
            }

            $route->setParameter($parameter->getName(), $parameterUuidValue);
        }

        return $next($request);
    }
}
