<?php

namespace AIOSEO\Vendor\Psr\Log;

/**
 * Basic Implementation of LoggerAwareInterface.
 */
trait LoggerAwareTrait
{
    /**
     * The logger instance.
     *
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(\AIOSEO\Vendor\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
