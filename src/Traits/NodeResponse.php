<?php


namespace PAM\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use PAM\Resources\API;

trait NodeResponse
{
    /**
     * success response
     * @param $data
     * @param int $code
     * @return JsonResponse|object
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        if ($data instanceof Collection) {
            return API::collection($data)
                ->additional([
                    'success' => true
                ])
                ->response()
                ->setStatusCode($code);
        }

        return (new API($data))
            ->additional([
                'success' => true
            ])
            ->response()
            ->setStatusCode($code);
    }

    /**
     * failed response
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse($message, int $code): JsonResponse
    {
        return (new API([
            'message' => $message
        ]))->additional([
            'success' => false,
        ])->response()->setStatusCode($code);
    }
}
