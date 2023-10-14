<?php

namespace App\TestTask\Requests;

use App\TestTask\Services\TestTaskService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Шлюз
 */
class SendRequest
{
    protected Client $client;
    protected string $baseUrl;
    private TestTaskService $testTaskService;

    public function __construct(TestTaskService $testTaskService)
    {
        $this->client = new Client();
        $this->baseUrl = env('BASE_URL');
        $this->testTaskService = $testTaskService;
    }

  /**
   * @return bool|array
   */
    public function request(): bool|array
    {
        try {
            $response = $this->client->get($this->baseUrl . "/?results=5000");

            if ($response->getStatusCode() === 200) {
                return $this->testTaskService->resolve(json_decode($response->getBody(), true));
            }
        } catch (GuzzleException $e) {
            // Обработка ошибок Guzzle
        }

        return false;
    }
}
