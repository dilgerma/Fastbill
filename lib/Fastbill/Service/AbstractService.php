<?php


namespace Fastbill\Service;


use Fastbill\Fastbill;
use Fastbill\ApiException;
use Fastbill\HttpClient;
use Fastbill\HttpClientException;

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
     * @param $request array
     * @param $method string
     * @throws \Fastbill\lib\ApiException
     * @return array
     */
    final public function call(array $request, $method)
    {
        $finalRequest = array(
            'SERVICE' => $this->getServiceName() . '.' . $method,
            'DATA' => $request
        );
        $body = json_encode($finalRequest);
        $this->httpClient->addHeader('Content-Length', strlen($body));
        $response = $this->httpClient->request($body);
        if (isset($response['ERRORS'])) {
            throw new ApiException(implode(', ', $response['ERRORS']));
        }

        return $response;
    }
}
