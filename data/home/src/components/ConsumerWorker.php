<?php
namespace src\components;

use src\main\AbstractWorker;

class ConsumerWorker extends AbstractWorker
{
    public function __construct(string $name)
    {
        $this->name = $name;
        parent::__construct();
    }

    public function execute(): void
    {
        $number = $this->queue->rpop($this->name);
        $count_field = 'count_' . substr($this->name, 0, 3);

        if ($number) {
            $this->logger->write($this->name . 'Consumer.log', $number);

            $queryResult = $this->storage->query("SELECT sum, {$count_field} FROM task where id = 1 FOR UPDATE");
            $rows = $queryResult->assoc();
            $sum = bcadd($rows['sum'], $number);
            $this->storage->query("UPDATE task SET sum = {$sum}, {$count_field} = {$count_field} + 1");
        }

    }
}