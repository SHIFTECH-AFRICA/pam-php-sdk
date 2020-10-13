<?php
/**
 * ------------------------------------
 * Define all the request options here
 * ------------------------------------
 */
return [
    /**
     * ------------------------------------
     * set the base endpoint and urls here
     * ------------------------------------
     */
    'url' => [
        'endpoint' => 'https://pam.api.easyncpay.com/api/v1/',
        'pam' => [
            'token' => 'token', // GET
            'shortcode' => 'shortcode', // GET
            'app' => 'app', // GET
        ],
        'm_pesa' => [
            'shortcode_validate' => 'm-pesa/shortcode/validate', // POST
            'stk_push' => 'm-pesa/c2b/stk-push', // POST
            'reg_c2b_url' => 'm-pesa/c2b/register-url', // POST
        ],
    ],

    /**
     * ---------------------------------------------------------------
     * This should be the api account token that is generated in the
     * pam account.
     * ---------------------------------------------------------------
     */
    'pam_token' => env('PAM_API_TOKEN', 'bm9kZTw+c2VjcmV0'),

    /**
     * ---------------------------------------------------------------------------------------------------
     * The timeout is the time given for the response to be given if no response is given
     * in 120 seconds the request is dropped.
     * You are free to set your timeout
     * ---------------------------------------------------------------------------------------------------
     */
    'timeout' => env('TIMEOUT', 120), // Response timeout 120sec

    /**
     * ---------------------------------------------------------------------------------------------------
     * The connection timeout is the time given for the request to acquire full connection to the
     * end point url. So if not connection is made in 60 seconds the request is dropped.
     * Your free to set your own connection timeout.
     * ---------------------------------------------------------------------------------------------------
     */
    'connect_timeout' => env('CONNECTION_TIMEOUT', 60), // Connection timeout 60sec
];
