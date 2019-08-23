<?php
namespace src\components;

class Logger
{
    public function write(string $fileName, string $message, bool $fileAppend = true): void
    {
        file_put_contents(
            '/home/testuser/log/' . $fileName,
            "{$message}\n",
            $fileAppend ? FILE_APPEND : 0
        );
    }

    public function read(): array
    {
        
    }
}