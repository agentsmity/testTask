<?php
namespace src\components\workers;

use go\DB\DB;
use Predis\Client;
use src\components\Logger;
use src\config\Constants;

abstract class AbstractWorker implements WorkerInterface
{
    const DEF_USLEEP = 100000;
    protected $storage;
    protected $queue;
    protected $logger;
    protected $usleep;
    protected $iterator;
    protected $name;

    public function __construct(string $name, callable $iterator, ?int $usleep)
    {
        $this->storage = DB::create(Constants::MYSQL_PARAMS, 'mysql');
        $this->queue = new Client(Constants::REDIS_PARAMS);
        $this->logger = new Logger;
        $this->name = $name;
        $this->iterator = $iterator;
        $this->usleep = $usleep ?? self::DEF_USLEEP;
    }

    abstract function execute($i): void;

    public function run(): void
    {
        while($i = ($this->iterator)()) {
            $this->execute($i);
            usleep($this->usleep);
        }
    }
}