<?php
namespace src\components\workers;

class ProducerWorker extends AbstractWorker
{
    public function execute($number): void
    {
        $this->logger->write($this->name . 'Producer.log', $number);
        $this->queue->lpush($this->name, $number);
    }
}