<?php
namespace src\main;

class Constants
{
    public const MYSQL_PARAMS = [
        'host'     => 'mysql',
        'username' => 'user',
        'password' => 'test',
        'dbname'   => 'test',
        'charset'  => 'utf8',
    ];
    
    public const REDIS_PARAMS = [
        'host' => 'redis',
        'port' => 6379,
        'database' => 1,
    ];
}