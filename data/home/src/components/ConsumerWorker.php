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
        $data = $this->queue->fetch($this->name);
        $this->storage->execute("
            SELECT * FROM task where id = 1 FOR UPDATE;
            UPDATE task SET 
        ");
    }
}