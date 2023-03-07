<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class AbstractException.
 */
abstract class AbstractTranslateException extends AbstractException
{
    /**
     * AbstractTranslateException constructor.
     *
     * @param string          $message
     * @param array           $messageParameters
     * @param array           $parameters
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = 'exception', array $messageParameters = [], array $parameters = [], $code = 0, \Throwable $previous = null)
    {
        global $kernel;
        $messageTrans = $message;
        if (null !== $kernel) {
            $translator = $kernel->getContainer()->get('translator');
            $messageTrans = $translator->trans($message, $messageParameters, 'exceptions');
        }
        parent::__construct($messageTrans, $parameters, $code, $previous);
    }
}
