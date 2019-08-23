<?php
namespace src\components\workers;

interface WorkerInterface
{
    public function run(): void;
}