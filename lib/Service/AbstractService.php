<?php


namespace Fastbill\Service;


use Fastbill\Fastbill;
use Fastbill\lib\ApiException;
use Fastbill\lib\HttpClient;
use Fastbill\lib\HttpClientException;

abstract class AbstractService
{
    /** @var  HttpClient */
    private $httpClient;

    final public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    abstract protected function getServiceName();

    /**
     * @param array $request
     * @return array
     * @throws HttpClientException
     * @throws ApiException
     */
    final public function call(array $request)
    {
        $body = json_encode($request);
        $this->httpClient->addHeader('Content-Length', strlen($body));
        $response = $this->httpClient->request($body);
        if (isset($response['ERRORS'])) {
            throw new ApiException(implode(', ', $response['ERRORS']));
        }

        return $response;
    }
}
