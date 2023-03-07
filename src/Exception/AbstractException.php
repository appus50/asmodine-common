<?php

namespace Asmodine\CommonBundle\Exception;

use Symfony\Component\HttpKernel\Kernel;

/**
 * Class AbstractException.
 */
abstract class AbstractException extends \Exception
{
    /**
     * AbstractException constructor.
     *
     * @param string          $message
     * @param array           $parameters
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = '', $parameters = [], $code = 0, \Throwable $previous = null)
    {
        global $kernel;
        parent::__construct($message, $code, $previous);

        $message = sprintf('[%s] %s', \get_class($this), $this->getMessage());
        $parameters = array_merge($parameters, [
            'file' => $this->getFile(),
            'line' => $this->getLine(),
            'code' => $this->getCode(),
        ]);
        if (null !== $this->getPrevious()) {
            $message = sprintf('[%s][%s] %s', \get_class($this), \get_class($previous), $this->getMessage());
            $parameters = array_merge($parameters, [
                'previous_file' => $this->getPrevious()->getFile(),
                'previous_line' => $this->getPrevious()->getLine(),
                'previous_code' => $this->getPrevious()->getCode(),
            ]);
        }
        if (null !== $kernel) {
            /** @var Kernel $kernel */
            $logger = $kernel->getContainer()->get('monolog.logger.exception');
            $logger->error($message, $parameters);
            $logger->debug($message, $this->getTrace());
        }
    }
}
