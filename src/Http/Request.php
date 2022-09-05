<?php

namespace DivDax\Easybill\Http;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Request
{
    protected $client;

    public function __construct($api_endpoint, $api_key)
    {
        $this->client = new Client([
            'base_uri' => $api_endpoint,
            'verify'   => false,
            'headers'  => [
                'Authorization' => 'Bearer ' . $api_key,
            ],
        ]);
    }

    /**
     * intercept response of all requests.
     * parse json response
     *
     * @param ResponseInterface $response
     *
     * @return mixed|ResponseInterface
     */
    protected function interceptResponse($response)
    {
        if ($response->getHeader('Content-Type')[0] === 'application/json') {
            return json_decode($response->getBody());
        }

        return $response;
    }

    public function get($url, $attributes = [])
    {
        $params = $attributes
            ? '?' . $this->build_url_query($attributes)
            : '';

        $response = $this->client->get($url . $params);

        return $this->interceptResponse($response);
    }

    public function post($url, $attributes = [])
    {
        $response = $this->client->post($url, $attributes);

        return $this->interceptResponse($response);
    }

    public function put($url, $attributes = [])
    {
        $response = $this->client->put($url, $attributes);

        return $this->interceptResponse($response);
    }

    public function delete($url, $attributes = [])
    {
        $response = $this->client->delete($url, $attributes);

        return $this->interceptResponse($response);
    }

    private function build_url_query($url)
    {
        if (is_array($url)) {
            $url = http_build_query($url);
        }

        return trim($url, '/');
    }
}
