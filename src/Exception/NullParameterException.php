<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class NullParameterException.
 */
class NullParameterException extends AbstractTranslateException
{
    /**
     * NullParameterException constructor.
     *
     * @param string $class
     * @param string $method
     * @param string $parameter
     */
    public function __construct(string $class, string $method, string $parameter)
    {
        parent::__construct('null_parameter', ['%class%' => $class, '%method%' => $method, '%parameter%' => $parameter]);
    }
}
