<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;
use Response;

class ResponseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $formatResponse = function ($data, ?int $code, ?array $meta): array {
            $res = array_filter([
                'data' => $data,
                'code' => $code,
            ]);

            if ($meta) {
                foreach ($meta as $key => $value) {
                    if (!isset($res[$key])) {
                        $res[$key] = $value;
                    }
                }
            }

            return $res;
        };

        Response::macro('success', function ($data = null, int $status = 200, int $code = null, array $meta = null) use ($formatResponse): JsonResponse {
            $res = array_merge([
                'success' => true,
            ], $formatResponse($data, $code, $meta));

            return Response::json($res, $status);
        });

        Response::macro('error', function ($message = null, $data = null, int $status = 500, int $code = null, array $meta = null) use ($formatResponse): JsonResponse {
            $res = array_merge([
                'success' => false,
            ], array_filter([
                'message' => $message,
            ]), $formatResponse($data, $code, $meta));

            return Response::json($res, $status);
        });
    }
}
