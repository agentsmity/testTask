<?php
namespace src\components;

use src\main\AbstractWorker;

class ProducerWorker extends AbstractWorker
{
    public function __construct(string $name)
    {
        $this->name = $name;
        parent::__construct();
    }

    public function execute()
    {
        $number = $this->generatorFuction();
        
        if ($number) {
            $this->queue->lpush($this->name, $number);
        }
    }
}