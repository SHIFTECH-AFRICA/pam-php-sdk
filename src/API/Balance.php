<?php

namespace PAM\API;

use Exception;
use Illuminate\Http\Response;
use PAM\Traits\NodeProcessing;
use PAM\Traits\NodeResponse;

class Balance
{
    use NodeProcessing, NodeResponse;

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
