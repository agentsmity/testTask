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
        $this->queue->save($this->name, $this->generatorFuction());
    }
}