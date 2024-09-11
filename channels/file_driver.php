<?php

namespace sts\debug\logs\channels;

use sts\debug\interfaces\LogChannelInterface;

class FileDriver implements LogChannelInterface
{
    private $logFile;

    public function __construct($filePath)
    {
        $this->logFile = $filePath;
    }

    public function log($level, $message, array $context = [])
    {
        $date = new \DateTime();
        $formattedMessage = sprintf("[%s] [%s]: %s %s%s", $date->format('Y-m-d H:i:s'), strtoupper($level), $message, json_encode($context), PHP_EOL);
        file_put_contents($this->logFile, $formattedMessage, FILE_APPEND);
    }
}
