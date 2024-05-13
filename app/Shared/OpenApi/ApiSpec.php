<?php

declare(strict_types=1);

namespace App\Shared\OpenApi;

use OpenApi\Annotations as OA;

/**
 * ---------- Pagination schemas ----------
 *
 * @OA\Schema(
 *    schema="links",
 *    @OA\Property(property="first", type="string", example="https://example.com/api/things?page=1"),
 *    @OA\Property(property="last", type="string", example="https://example.com/api/things?page=7"),
 *    @OA\Property(property="next", type="string", nullable=true, example="https://example.com/api/things?page=2"),
 *    @OA\Property(property="prev", type="string", nullable=true, example=null),
 * )
 *
 * @OA\Schema(
 *    schema="meta",
 *    @OA\Property(property="current_page", type="integer", example="1"),
 *    @OA\Property(property="from", type="integer", example="1"),
 *    @OA\Property(property="last_page", type="integer", example="7"),
 *    @OA\Property(property="path", type="string", example="https://example.com/api/things"),
 *    @OA\Property(property="per_page", type="integer", example="10"),
 *    @OA\Property(property="to", type="integer", example="10"),
 *    @OA\Property(property="total", type="integer", example="70"),
 * )
 *
 *
 * ---------- Common responses ----------
 *
 * @OA\Response(
 *    response="created",
 *    description="Resource created",
 *    @OA\JsonContent(
 *       @OA\Property(property="code", type="integer", example="201"),
 *       @OA\Property(property="message", type="string", example="Resource created"),
 *       @OA\Property(property="id", type="string", format="uuid", example="7d20ed5d-9d6c-3bcb-9fa6-75d659abfa7a")
 *    )
 * )
 *
 * @OA\Response(
 *    response="unauthenticated",
 *    description="Unauthenticated",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Unauthenticated")
 *    )
 * )
 *
 * @OA\Response(
 *    response="unauthorized",
 *    description="Unauthorized",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="User does not have the right roles.")
 *    )
 * )
 *
 * @OA\Response(
 *    response="conflict",
 *    description="Resource already exists",
 *    @OA\JsonContent(
 *       @OA\Property(property="code", type="integer", example="409"),
 *       @OA\Property(property="message", type="string", example="Resource already exists")
 *    )
 * )
 *
 * @OA\Response(
 *    response="unprocessable-entity",
 *    description="Request failed due to internal error on service layer",
 *    @OA\JsonContent(
 *       @OA\Property(property="code", type="integer", example="422"),
 *       @OA\Property(property="message", type="string", example="Request failed due to semantic validation")
 *    )
 * )
 *
 * @OA\Response(
 *     response="error",
 *     description="Internal server error",
 *     @OA\JsonContent(
 *        @OA\Property(property="code", type="integer", example="500"),
 *        @OA\Property(property="message", type="string", example="Internal server error")
 *     )
 *  )
 */
final class ApiSpec
{
    private function __construct()
    {
    }
}
