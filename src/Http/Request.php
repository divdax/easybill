<?php

namespace DivDax\Easybill\Http;

use GuzzleHttp\Client;

class Request
{
    protected $client;

    public function __construct($api_endpoint, $api_key)
    {
        $this->client = new Client([
            'base_uri' => $api_endpoint,
            'headers' => [
                'Authorization' => 'Bearer ' . $api_key
            ]
        ]);
    }

    public function get($url, $attributes = null)
    {
        $params = $attributes
            ? '?' . $this->build_url_query($attributes)
            : '';

        $data = $this->client->get($url . $params)->getBody();
        return json_decode($data);
    }

    public function post($url, $attributes = null)
    {
        $data = $this->client->post($url, $attributes)->getBody();
        return json_decode($data);
    }

    public function put($url, $attributes = null)
    {
        $data = $this->client->put($url, $attributes)->getBody();
//        var_dump($data);
//        die();
        return json_decode($data);
    }

    public function delete($url, $attributes = null)
    {
        $data = $this->client->delete($url, $attributes)->getBody();
        return json_decode($data);
    }

    private function build_url_query($url)
    {
        if(is_array($url)) {
            $url = http_build_query($url);
        }
        return trim($url, '/');
    }
}