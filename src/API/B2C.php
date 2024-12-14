<?php


namespace PAM\API;


use Exception;
use Illuminate\Http\Response;
use PAM\Traits\NodeProcessing;
use PAM\Traits\NodeResponse;

class B2C
{
    use NodeProcessing, NodeResponse;

    /**
     * -------------------------------
     * Initiate b2c for m-pesa
     * transactions
     * -------------------------------
     * @param array $options
     * @return mixed
     */
    public function initiateB2C(array $options): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.m_pesa.b2c'),
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
