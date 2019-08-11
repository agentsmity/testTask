<?php
namespace src;

use src\main\WorkerInterface;
use src\components\ProducerWorker;
use src\components\ConsumerWorker;
use src\components\Logger;

class Application
{
    public function __construct()
    {
        $this->logger = new Logger;
    }

    public function initialize(array $params): WorkerInterface {
        $workerType = $params['t'] ?? '';
        $numberType = $params['n'] ?? '';
        $amount = $params['amount'] ?? null;
        $usleep = $params['usleep'] ?? null;

        $methodName = 'get' . ucfirst($workerType) . 'Worker';
        $generatorFunction = 'get' . ucfirst($numberType) . 'GeneratorFunction';

        if (!method_exists($this, $methodName)) {
            throw new \Exception('Wrong worker type.');
        }

        if (!method_exists($this, $generatorFunction)) {
            throw new \Exception('Wrong type of numbers.');
        }

        return call_user_func(
            [$this, $methodName],
            [$numberType => $this->$generatorFunction($amount, $usleep)]
        );
    }

    public function log(string $message)
    {
        $this->logger->write($message);
    }

    private function getProducerWorker(array $param): ProducerWorker
    {
        return new ProducerWorker(key($param), current($param));
    }

    private function getConsumerWorker(array $param): ConsumerWorker
    {
        return new ConsumerWorker(key($param));
    }

    private function getFibonacciGeneratorFunction(?int $amount, ?int $usleep): callable
    {
        return function() use ($amount, $usleep) {
            static $i = 0;

            if ($i++ < $amount) {
                usleep($usleep);
                return round(pow((sqrt(5)+1)/2, $i) / sqrt(5));
            }

            return null;
        };
    }

    private function getSimplyGeneratorFunction(?int $amount, ?int $usleep): callable
    {
        return function() use ($amount, $usleep) {
            static $i = 0;

            if ($i++ < $amount) {
                usleep($usleep);
                return $i;
            }

            return null;
        };
    }
}