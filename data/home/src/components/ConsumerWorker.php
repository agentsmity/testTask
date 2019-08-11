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
            $this->storage->query("SELECT sum, {$count_field} FROM task where id = 1 FOR UPDATE");
            $this->storage->query("UPDATE task SET sum = sum + {$number}, {$count_field} = {$count_field} + 1");
        }
    }
}