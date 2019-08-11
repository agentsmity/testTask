<?php
namespace src\components;

class Logger
{
    public function write(string $message): void
    {
        file_put_contents('/home/testuser/log', $message . "\n\n");
    }

    public function read(): array
    {
        
    }
}