<?php

namespace PAM\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class API extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }

    /**
     * show return with something
     * @param $request
     * @return array
     */
    #[ArrayShape(['api-version' => "string", 'author' => "string", 'author-url' => "\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string"])]
    public function with($request): array
    {
        return [
            'api-version' => '1.0.0',
            'author' => 'easyncpay',
            'author-url' => url('https://easyncpay.com'),
        ];
    }
}
