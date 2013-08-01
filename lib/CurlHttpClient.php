<?php


namespace Fastbill\lib;

require_once __DIR__ . '/HttpClient.php';

class CurlHttpClient implements HttpClient
{
    /** @var resource */
    private $handle;

    private $headers = array(
        'Content-Type' => 'Content-Type: application/json'
    );

    public function __construct()
    {
        $this->handle = curl_init();
        curl_setopt_array($this->handle, array(
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true
            )
        );
    }

    /**
     * @param $url string
     */
    public function setUrl($url)
    {
        curl_setopt($this->handle, CURLOPT_URL, $url);
    }

    /**
     * @param $key string
     * @param $value string
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $key . ':' . $value;
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, $this->headers);
    }

    /**
     * @param array $body
     * @return array
     * @throws HttpClientException
     */
    public function request($body)
    {
        curl_setopt($this->handle, CURLOPT_POSTFIELDS, json_encode($body));
        $response = curl_exec($this->handle);
        $info = curl_getinfo($this->handle);

        if ($info['http_code'] === 200) {
            $json = json_decode($response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $json;
            } else {
                throw new HttpClientException('JSON was not valid: ' . $response);
            }
        } else {
            throw new HttpClientException('HttpCode was not 200: ' . $info['http_code'], $info['http_code']);
        }
    }
}
