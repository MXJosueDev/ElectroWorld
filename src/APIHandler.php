<?php

namespace Josue\Electroworld;

use Closure;

class APIHandler
{
    private Closure $GET;
    private Closure $POST;
    private Closure $PUT;
    private Closure $DELETE;

    public function GET(Closure $callback): void
    {
        $this->GET = $callback;
    }

    public function POST(Closure $callback): void
    {
        $this->POST = $callback;
    }

    public function PUT(Closure $callback): void
    {
        $this->PUT = $callback;
    }

    public function DELETE(Closure $callback): void
    {
        $this->DELETE = $callback;
    }

    public function getCallback(string $method): ?Closure
    {
        return match ($method) {
            'GET' => $this->GET ?? null,
            'POST' => $this->POST ?? null,
            'PUT' => $this->PUT ?? null,
            'DELETE' => $this->DELETE ?? null,
            default => null,
        };
    }

    public static function response(int $status, mixed $data): void
    {
        http_response_code($status);

        if ($data === null) {
            http_response_code(500);
            echo json_encode(['error' => 'No data found']);

            exit();
        }

        echo json_encode($data);
        exit();
    }

    public function handleRequest()
    {
        http_response_code(500);

        $method = $_SERVER['REQUEST_METHOD'];
        $callback = $this->getCallback($method);

        if (!($callback instanceof Closure)) {
            $this->response(405, ['error' => 'Method not allowed']);
            exit();
        }

        $reflectionCallback = new \ReflectionFunction($callback);
        $params = $reflectionCallback->getParameters();

        $input = file_get_contents("php://input");
        
        $data = [];
        if (!empty($input)) {
            $jsonDecoded = json_decode($input, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data = $jsonDecoded;
            } else {
                parse_str($input, $data);
            }
        }

        $callbackArgs = [];

        foreach ($params as $param) {
            $paramName = $param->getName();
            $paramType = $param->getType();

            if (!isset($_REQUEST[$paramName]) && !isset($data[$paramName])) {
                $this->response(400, ['error' => "Missing parameter: {$paramName}"]);
                exit();
            }

            if (isset($_REQUEST[$paramName])) {
                $paramValue = $_REQUEST[$paramName];
            }
            if (isset($data[$paramName])) {
                $paramValue = $data[$paramName];
            }

            if ($paramType->getName() === 'int') {
                $paramValue = (int) $paramValue;
            }

            if ($paramType->getName() === 'float') {
                $paramValue = (float) $paramValue;
            }

            if ($paramType->getName() === 'string') {
                $paramValue = Utils::normalizeText($paramValue);
            }

            $callbackArgs[$paramName] = $paramValue;
        }

        try {
            [$status, $response] = $callback(...$callbackArgs);
        } catch (\Exception $e) {
            $this->response(500, ['error' => $e->getMessage()]);
            exit();
        }

        self::response($status, $response);
    }
}
