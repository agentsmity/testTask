<?php
require_once __DIR__ . '/vendor/autoload.php';
//db migration
$connectionParams = src\main\Constants::MYSQL_PARAMS;
unset($connectionParams['dbname']);
$db = go\DB\DB::create($connectionParams, 'mysql');
$db->query('
    DROP DATABASE IF EXIST test;
    CREATE DATABASE test;
    USE test;
    CREATE TABLE task (
        `id` tinyint(1) NOT NULL AUTO_INCREMENT,
        `sum` bigint(12) unsigned NOT NULL DEFAULT 0,
        `count_fib` smallint(4) NOT NULL DEFAULT 0,
        `count_sim` smallint(4) NOT NULL DEFAULT 0,
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    INSERT INTO task (id) VALUES (1);
');

