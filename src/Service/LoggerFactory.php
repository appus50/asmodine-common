<?php

namespace Asmodine\CommonBundle\Service;

use Asmodine\CommonBundle\Exception\EnumParameterException;
use Psr\Log\LoggerInterface;

/**
 * Class LoggerFactory.
 */
class LoggerFactory
{
    protected $channels = [];

    /**
     * @param $name
     * @param $loggerObject
     */
    public function addChannel($name, $loggerObject): void
    {
        $this->channels[$name] = $loggerObject;
    }

    /**
     * @param string $channel
     *
     * @throws EnumParameterException
     *
     * @return LoggerInterface
     */
    public function getLogger(string $channel): LoggerInterface
    {
        if (\array_key_exists($channel, $this->channels)) {
            return $this->channels[$channel];
        }

        throw new EnumParameterException($channel, array_keys($this->channels));
    }
}
