<?php
namespace src\main;

use go\DB\DB;
use Predis\Client;
use src\components\Logger;

abstract class AbstractWorker implements WorkerInterface
{
    protected $storage;
    protected $queue;
    protected $logger;

    public function __construct()
    {
        $this->storage = DB::create(Constants::MYSQL_PARAMS, 'mysql');
        $this->queue = new Client(Constants::REDIS_PARAMS);
        $this->logger = new Logger;
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