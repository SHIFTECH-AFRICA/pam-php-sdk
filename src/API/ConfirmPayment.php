<?php

namespace PAM\API;

use Exception;
use Illuminate\Http\Response;
use PAM\Traits\NodeProcessing;
use PAM\Traits\NodeResponse;

class ConfirmPayment
{
    use NodeProcessing, NodeResponse;

    /**
     * confirm if payment was
     * made for the stk
     * payment
     * to get the callbacks
     * @param array $options
     * @return mixed
     */
    public function stkPayment(array $options): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.m_pesa.confirm_stk_payment'),
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

    /**
     * confirm if thw withdraw
     * was done to the client
     * to get the callbacks
     * @param array $options
     * @return mixed
     */
    public function withdrawPayment(array $options): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.m_pesa.confirm_withdraw'),
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
