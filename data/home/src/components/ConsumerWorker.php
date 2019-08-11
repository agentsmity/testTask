<?php
namespace src\components;

use src\main\AbstractWorker;

class GeneratorWorker extends AbstractWorker
{
    protected $generatorFuction;

    public function __construct(string $name, callable $generatorFuction)
    {
        $this->name = $name;
        $this->generatorFuction = $generatorFuction;
        parent::__construct();
    }

    public function execute()
    {
        $number = $this->queue->rpop($this->name);

        if ($number) {
            $this->storage->execute("
                SELECT * FROM task where id = 1 FOR UPDATE;
                UPDATE task SET 
            ");
        }
    }
}