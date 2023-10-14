<?php

namespace App\TestTask\Http\Controllers;

use App\TestTask\Requests\SendRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Psr\Log\LoggerInterface;

class ImportController extends Controller
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(SendRequest $sendRequest): JsonResponse|bool|array|null
    {
        try {
            $request = $sendRequest->request();

            if ($request) {
                $this->logger->info('DONE');

                return response()
                    ->json(['result' => $request]);
            }
        } catch (Exception $e) {
            $this->logger->warning($e->getMessage());

            return response()
                ->json(['message' => $e->getMessage()], 400);
        }

        return null;
    }
}
