<?php
namespace src\components\workers;

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
            $this->logger->write($this->name . 'Consumer.log', substr($number, 0, 5));

            $queryResult = $this->storage->query("SELECT sum, count_fib, count_sim FROM task where id = 1 FOR UPDATE");
            $rows = $queryResult->assoc()[0];
            $sum = bcadd($rows['sum'], $number);

            $this->storage->query("UPDATE task SET sum = {$sum}, {$count_field} = {$count_field} + 1");

            $rows['sum'] = substr($rows['sum'], 0, 5);
            $sum = substr($sum, 0, 5);

            $this->logger->write(
                'dump.log',
                implode(",", array_merge($rows, [substr($number, 0, 5), $sum, $this->name]))
            );
        }

    }
}