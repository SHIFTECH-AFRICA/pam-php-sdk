<?php


namespace PAM\API;


use Exception;
use Illuminate\Http\Response;
use PAM\Traits\NodeProcessing;
use PAM\Traits\NodeResponse;

class RegC2bUrl
{
    use NodeProcessing, NodeResponse;

    /**
     * register the c2b urls
     * to get the callbacks
     * @param array $options
     * @return mixed
     */
    public function registerC2BURL(array $options): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.m_pesa.reg_c2b_url'),
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
