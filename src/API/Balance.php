<?php

namespace PAM\API;

use Exception;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;
use PAM\Traits\NodeProcessing;
use PAM\Traits\NodeResponse;

class Balance
{
    use NodeProcessing, NodeResponse;

    /**
     * @var Repository|Application|mixed
     */
    private mixed $baseUri;

    /**
     * -----------------------------
     * create class instance here
     * -----------------------------
     */
    public function __construct()
    {
        $this->baseUri = config('pam.url.endpoint');
    }

    /**
     * get the balance
     * @param array $options
     * @return mixed
     */
    public function checkBalance(array $options): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.m_pesa.balance'),
                'POST',
                $options
            ));
        } catch (Exception $exception) {
            return $this->errorResponse(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
