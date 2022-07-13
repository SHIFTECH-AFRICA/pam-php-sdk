<?php


namespace PAM\API;


use Exception;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;
use PAM\Traits\NodeProcessing;
use PAM\Traits\NodeResponse;

class App
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
     * -------------------------------
     * get all the apps in
     * database from the api
     * -------------------------------
     * @return mixed
     */
    public function index(): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.pam.app'),
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
     * get specific app object
     * @param string $id
     * @return mixed
     * --------------------------------
     */
    public function show(string $id): mixed
    {
        try {
            return json_decode($this->processRequest(
                config('pam.url.pam.app') . '/' . $id,
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
