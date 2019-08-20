<?php
namespace src\components;

class Logger
{
    public function write(string $fileName, string $message): void
    {
        file_put_contents('/home/testuser/log/' . $fileName, "{$message}\n", FILE_APPEND);
    }

    public function read(): array
    {
        
    }
}