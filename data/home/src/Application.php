<?php
namespace src;

use src\components\workers\WorkerInterface;
use src\components\Logger;
use src\components\Request;
use src\components\Factory;

class Application
{
    private $logger;
    private $request;

    public function __construct()
    {
        $this->logger = new Logger;
        $this->request = new Request;
        $this->factory = new Factory;
    }

    public function run(): void
    {
        try {
            $this->initialize()->run();
        } catch (\Exception $e) {
            $this->logger->write('errors.log', $e->getMessage());
        }
    }

    public function initialize(): WorkerInterface {
        $workerType = $this->request->t;
        $numberType = $this->request->n;
        $amount = $this->request->amount;
        $usleep = $this->request->usleep;

        return $this->factory->get($workerType, $numberType, $amount, $usleep);
    }
}