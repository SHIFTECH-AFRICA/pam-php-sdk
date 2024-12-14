<?php


namespace PAM\API;


use Exception;
use Illuminate\Http\Response;
use PAM\Traits\NodeProcessing;
use PAM\Traits\NodeResponse;

class ShortCode
{
    use NodeProcessing, NodeResponse;

    /**
     * -------------------------------
     * get all the shortcodes in
     * database from the api
     * -------------------------------
     * @return mixed
     */
    public function index(): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.pam.shortcode'),
                'GET',
            ));
        } catch (Exception $exception) {
            return $this->errorResponse(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * --------------------------------
     * get specific shortcode object
     * @param string $id
     * @return mixed
     * --------------------------------
     */
    public function show(string $id): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.pam.shortcode') . '/' . $id,
                'GET',
            ));
        } catch (Exception $exception) {
            return $this->errorResponse(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * ----------------------------------------
     * validate the shortcode from the m-pesa
     * portal 'Daraja'
     * @param array $options
     * @return mixed
     * ----------------------------------------
     */
    public function validate(array $options)
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.m_pesa.shortcode_validate'),
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
