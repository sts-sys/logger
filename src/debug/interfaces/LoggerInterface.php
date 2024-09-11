<?php

namespace sts\debug\interfaces;

interface LoggerInterface
{
    // Metodele de bază pentru logare
    public function log($level, $message, array $context = []);
    public function debug($message, array $context = []);
    public function info($message, array $context = []);
    public function notice($message, array $context = []);
    public function warning($message, array $context = []);
    public function error($message, array $context = []);
    public function critical($message, array $context = []);
    
    // Metode pentru funcționalități suplimentare
    public function setFormatter(callable $formatter);
    public function registerErrorHandlers();
    public function addCallback(callable $callback);
    public function addFilter(callable $filter);
    public function setRetentionPolicy(int $days);
}
