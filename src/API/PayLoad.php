<?php


namespace PAM\API;


use Exception;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;
use PAM\Traits\NodeProcessing;
use PAM\Traits\NodeResponse;

class PayLoad
{
    use NodeProcessing, NodeResponse;

    /**
     * @var Repository|Application|mixed
     */
    private $baseUri;

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
     * -------------------------------
     * get all the payloads in
     * database from the api
     * -------------------------------
     * @return mixed
     */
    public function index()
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.pam.pay_loads'),
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
     * get specific payload object
     * @param string $id
     * @return mixed
     * --------------------------------
     */
    public function show(string $id)
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.pam.pay_loads') . '/' . $id,
                'GET',
            ));
        } catch (Exception $exception) {
            return $this->errorResponse(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
