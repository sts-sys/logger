<?php

namespace sts\debug\logs;

use sts\debug\interfaces\LoggerInterface;
use sts\debug\interfaces\LogChannelInterface;

class Logger implements LoggerInterface
{
    private $channels = [];

    public function addChannel(LogChannelInterface $channel)
    {
        $this->channels[] = $channel;
    }

    public function log($level, $message, array $context = [])
    {
        foreach ($this->channels as $channel) {
            $channel->log($level, $message, $context);
        }
    }

    public function debug($message, array $context = [])
    {
        $this->log('debug', $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->log('info', $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->log('notice', $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->log('warning', $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->log('error', $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->log('critical', $message, $context);
    }
}

