<?php
namespace src;

use src\components\workers\WorkerInterface;
use src\components\workers\ProducerWorker;
use src\components\workers\ConsumerWorker;
use src\components\Logger;
use src\components\Request;

class Application
{
    private $logger;
    private $request;

    public function __construct()
    {
        $this->logger = new Logger;
        $this->request = new Request;
    }

    public function initialize(): WorkerInterface {
        $workerType = $this->request->t;
        $numberType = $this->request->n;
        $amount = $this->request->amount;
        $usleep = $this->request->usleep;

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
        $this->logger->write('errors.log', $message);
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
                return bcdiv(bcpow((sqrt(5)+1)/2, $i), sqrt(5), 0);
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
                return bcsub(bcpow(2, $i), 1);
            }

            return null;
        };
    }
}