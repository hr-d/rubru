<?php

namespace HRD\Rubru\HttpClients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Class GuzzleHttpClient.
 */
class GuzzleHttpClient
{
    /**
     * HTTP client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Timeout of the request in seconds.
     *
     * @var int
     */
    protected $timeOut = 30;

    /**
     * @var ErrorHandling
     */
    protected $errorHandling;

    /**
     * GuzzleHttpClient constructor.
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
        $this->errorHandling = new ErrorHandling();
    }

    /**
     * make request
     *
     * @param string $url
     * @param string $method
     * @param array $params
     * @param array $headers
     * @return mixed
     * @throws \Exception
     */
    public function make(string $url, string $method, array $params, array $headers = [])
    {
        try {
            $response = $this->client->request($method, $url, [
                'json' => $params,
                'headers' => $headers,
                'timeOut' => $this->timeOut
            ]);
            $result = $response->getBody();

            if ($this->isJson($result)) {
                $result = json_decode($response->getBody(), true);
            }

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                return $result;
            }
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $result = json_decode($response->getBody(), true);
            $this->errorHandling->fire($response->getStatusCode(), $result);
        } catch (\Exception $e) {
            $this->errorHandling->fire($response->getStatusCode(), []);
        }
    }

    /**
     * Sets HTTP client.
     *
     * @param Client $client
     *
     * @return GuzzleHttpClient
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Gets HTTP client for internal class use.
     *
     * @return Client
     */
    private function getClient()
    {
        return $this->client;
    }

    /**
     * @param int $timeOut
     * @return int
     */
    public function setTimeOut(int $timeOut)
    {
        return $this->timeOut = $timeOut;
    }

    /**
     * @return int
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * @param $string
     * @return bool
     */
    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
