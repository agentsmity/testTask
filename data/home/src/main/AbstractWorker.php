<?php
namespace src\main;

use go\DB\DB;
use Predis\Client;

abstract class AbstractWorker implements WorkerInterface
{
    protected $storage;
    protected $queue;

    protected $name;

    public function __construct()
    {
        $this->storage = DB::create(\Constants::MYSQL_PARAMS, 'mysql');
        $this->queue = new Predis\Client(\Constants::REDIS_PARAMS);
    }

    abstract function execute(): void;

    public function run(): void
    {
        while(true) {
            $this->execute();
            usleep(100000);
        }
    }
}