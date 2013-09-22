<?php
namespace Fastbill\lib;

require_once __DIR__ . '/HttpClientException.php';

interface HttpClient
{
    /**
     * @param $url string
     * @return void
     */
    public function setUrl($url);

    /**
     * @param $key string
     * @param $value string
     * @return void
     */
    public function addHeader($key, $value);

    /**
     * @param $body string
     * @return array
     * @throws HttpClientException
     */
    public function request($body);
}
