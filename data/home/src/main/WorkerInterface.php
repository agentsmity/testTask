<?php
namespace src\main;

interface WorkerInterface
{
    public function run(): void;
}