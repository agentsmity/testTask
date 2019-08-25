<?php

namespace src\components;

use src\components\workers\WorkerInterface;
use src\components\workers\ProducerWorker;
use src\components\workers\ConsumerWorker;

class Factory
{
    public function get(
        string $workerType,
        string $numberType,
        ?int $amount,
        ?int $usleep
    ): WorkerInterface {
        $methodName = 'get' . ucfirst($workerType) . 'Worker';
        $generatorFunction = 'get' . ucfirst($numberType) . 'GeneratorFunction';

        if (!method_exists($this, $methodName)) {
            throw new \Exception('Wrong worker type.');
        }

        if (!method_exists($this, $generatorFunction) || empty($amount)) {
            $iterator = $this->getDefaultGeneratorFunction();
        } else {
            $iterator = $this->$generatorFunction($amount);
        }

        return call_user_func(
            [$this, $methodName],
            $numberType,
            $iterator,
            $usleep
        );
    }

    private function getProducerWorker(string $name, callable $iterator, ?int $usleep): ProducerWorker
    {
        return new ProducerWorker($name, $iterator, $usleep);
    }

    private function getConsumerWorker(string $name, callable $iterator, ?int $usleep): ConsumerWorker
    {
        return new ConsumerWorker($name, $iterator, $usleep);
    }

    private function getFibonacciGeneratorFunction(?int $amount): callable
    {
        return function() use ($amount) {
            static $i = 1;

            if ($i++ <= $amount) {
                $num = explode('.', bcdiv(bcpow((sqrt(5)+1)/2, $i), sqrt(5), 1));
                return bcadd($num[0], round(intval($num[1])/10));
            }

            return null;
        };
    }

    private function getSimplyGeneratorFunction(?int $amount): callable
    {
        return function() use ($amount) {
            static $i = 1;

            if ($i++ <= $amount) {
                return bcsub(bcpow(2, $i), 1);
            }

            return null;
        };
    }

    private function getDefaultGeneratorFunction(): callable
    {
        return function() {
            return true;
        };
    }
}