<?php
require_once __DIR__ . '/vendor/autoload.php';

$application = new src\Application();

try {
    $application->initialize()->run();
} catch (Exception $e) {
    $application->log($e->getMessage());
}