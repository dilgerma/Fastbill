<?php


namespace Fastbill\lib;
require_once __DIR__ . '/ApiException.php';

class HttpClientException extends ApiException
{
    public function __construct($message, $code = 200)
    {
        parent::__construct($message, $code, null);
    }

}
