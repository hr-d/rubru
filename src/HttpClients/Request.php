<?php

namespace HRD\Rubru\HttpClients;

use HRD\Rubru\Exception\AccessDenied;

class Request
{
    const RUBRU_BASE_URL_ENV_NAME = "RUBRU_BASE_URL";
    const RUBRU_USERNAME_ENV_NAME = "RUBRU_USERNAME";
    const RUBRU_PASSWORD_ENV_NAME = "RUBRU_PASSWORD";

    /**
     * @var GuzzleHttpClient
     */
    private $client;


    /**
     * Constructor.
     *
     * @param GuzzleHttpClient|null $client
     */
    public function __construct(GuzzleHttpClient $client = null)
    {
        $this->client = $client ?: new GuzzleHttpClient();
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function make(string $path, string $method, array $params)
    {
        if (!wincache_ucache_exists('Authorization')) {
            wincache_ucache_set('Authorization', $this->get_auth(), 86400); // the authorization caching for 24 hours
        }
        $Authorization = wincache_ucache_get('Authorization');
        try {
            return $this->client->make($this->get_apiUrl($path), $method, $params, [
                'Authorization' => "Bearer " . $Authorization,
                "Accept" => "application/json"]);
        } catch (AccessDenied $e) {
            wincache_ucache_clear();
            $this->make($path, $method, $params);
        }
    }

    /**
     * get_auth
     *
     * @return string
     * @throws \Exception
     */
    private function get_auth()
    {
        $username = getenv(self::RUBRU_USERNAME_ENV_NAME) ?? "";
        $password = getenv(self::RUBRU_PASSWORD_ENV_NAME) ?? "";
        try {
            $result = $this->client->make($this->get_apiUrl('authenticate'), [
                "username" => $username,
                "password" => $password,
                "captcha" => ""
            ]);
            return $result['id_token'];
        } catch (AccessDenied $e) {
            throw new \Exception();
        }
    }

    /**
     * @return string
     */
    public function base_url()
    {
        return $base_url = getenv(self::RUBRU_BASE_URL_ENV_NAME) ?? "https://online.rubru.me";
    }

    /**
     * @param string $path
     * @return string
     */
    private function get_apiUrl(string $path)
    {
        return $this->base_url() . '/api/' . $path;
    }
}
