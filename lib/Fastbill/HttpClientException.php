<?php

namespace Fastbill;

class HttpClientException extends ApiException
{
    public function __construct($message, $code = 200)
    {
        parent::__construct($message, $code, null);
    }

}
