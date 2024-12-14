<?php


namespace PAM\API;


use Exception;
use Illuminate\Http\Response;
use PAM\Traits\NodeProcessing;
use PAM\Traits\NodeResponse;

class STKPush
{
    use NodeProcessing, NodeResponse;

    /**
     * -------------------------------
     * Initiate stk push for m-pesa
     * express transactions
     * -------------------------------
     * @param array $options
     * @return mixed
     */
    public function initiateSTK(array $options): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.m_pesa.stk_push'),
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
