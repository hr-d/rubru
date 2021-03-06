<?php

namespace HRD\Rubru\HttpClients;

use HRD\Rubru\Exception\AccessDenied;

class Request
{
    const RUBRU_BASE_URL_ENV_NAME = "RUBRU_BASE_URL";
    const RUBRU_USERNAME_ENV_NAME = "RUBRU_USERNAME";
    const RUBRU_PASSWORD_ENV_NAME = "RUBRU_PASSWORD";
    const RUBRU_USER_ID_ENV_NAME = "RUBRU_USER_ID";

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
        $Authorization = $this->get_auth();
        try {
            return $this->client->make($this->get_apiUrl($path), $method, $params, [
                'Authorization' => "Bearer " . $Authorization]);
        } catch (AccessDenied $e) {
            $this->make($path, $method, $params);
        } catch (\Throwable $e) {
            throw $e;
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
            $result = $this->client->make($this->get_apiUrl('authenticate'), "post", [
                "username" => $username,
                "password" => $password,
                "captcha" => ""
            ]);
            return $result['id_token'];
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * @return string
     */
    public function base_url()
    {
        return getenv(self::RUBRU_BASE_URL_ENV_NAME) ?? "https://online.rubru.me";
    }

    /**
     * @param string $path
     * @return string
     */
    private function get_apiUrl(string $path)
    {
        return $this->base_url() . '/api/' . $path;
    }

    /**
     * @return int
     */
    public function user_id()
    {
        return getenv(self::RUBRU_USER_ID_ENV_NAME) ?? 0;
    }
}
