<?php

namespace PAM\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class API extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * show return with something
     * @param $request
     * @return array
     */
    public function with($request)
    {
        return [
            'api-version' => '1.0.0',
            'author' => 'easyncpay',
            'author-url' => url('https://easyncpay.com/'),
        ];
    }
}
