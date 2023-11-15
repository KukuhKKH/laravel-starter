<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;
use Response;

class ResponseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Response::macro('success', function($data = null, int $status = 200, int $code = null, array $meta = null) {
            $res = [
                'success' => true,
            ];

            return $this->makeResponse($data, $res, $code, $meta, $status);
        });

        Response::macro('error', function($message = null, $data = null, int $status = 500, int $code = null, array $meta = null) {
            $res = [
                'success' => false,
            ];

            if ($message !== null) {
                $res['message'] = $message;
            }

            return $this->makeResponse($data, $res, $code, $meta, $status);
        });
    }

    /**
     * @param mixed      $data
     * @param array      $res
     * @param int|null   $code
     * @param array|null $meta
     * @param int        $status
     * @return JsonResponse
     */
    protected function makeResponse(mixed $data, array $res, ?int $code, ?array $meta, int $status): JsonResponse
    {
        if ($data !== null) {
            $res['data'] = $data;
        }

        if ($code !== null) {
            $res['code'] = $code;
        }

        if ($meta) {
            foreach ($meta as $key => $value) {
                if (!isset($res[$key])) {
                    $res[$key] = $value;
                }
            }
        }

        return Response::json($res, $status);
    }
}
