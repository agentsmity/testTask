<?php
namespace src\components;

use src\main\AbstractWorker;

class ProducerWorker extends AbstractWorker
{
    protected $generatorFuction;

    public function __construct(string $name, callable $generatorFuction)
    {
        $this->name = $name;
        $this->generatorFuction = $generatorFuction;
        parent::__construct();
    }

    public function execute(): void
    {
        $number = ($this->generatorFuction)();
        
        if ($number) {
            $this->queue->lpush($this->name, $number);
        }
    }
}