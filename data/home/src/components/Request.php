<?php

namespace src\components;

class Request {
    private $options;

    public function __construct() {
        $this->options = getopt("t:n:", ["amount:", "usleep:"]);
    }

    public function __get(string $name)
    {
        return $this->options[$name] ?? null;
    }
}