<?php

namespace sts\debug\interfaces;

interface LogChannelInterface
{
    public function log($level, $message, array $context = []);
}
