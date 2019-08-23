<?php
require_once __DIR__ . '/vendor/autoload.php';

//mysql migration
$db = go\DB\DB::create(src\config\Constants::MYSQL_PARAMS, 'mysql');
$db->query('DROP TABLE IF EXISTS task');
$db->query('
    CREATE TABLE task (
        `id` tinyint(1) NOT NULL AUTO_INCREMENT,
        `sum` varchar(6000) NOT NULL DEFAULT \'0\',
        `count_fib` smallint(4) NOT NULL DEFAULT 0,
        `count_sim` smallint(4) NOT NULL DEFAULT 0,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8
');
$db->query('INSERT INTO task (id) VALUES (1)');


//redis migration
$redis = new Predis\Client(src\config\Constants::REDIS_PARAMS);
$redis->ltrim('fibonacci', -1, 0);
$redis->ltrim('simply', -1, 0);