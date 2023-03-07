<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class EmptyParameterException.
 */
class EmptyParameterException extends AbstractTranslateException
{
    /**
     * EmptyParameterException constructor.
     *
     * @param string $class
     * @param string $method
     * @param string $parameter
     */
    public function __construct(string $class, string $method, string $parameter)
    {
        parent::__construct('empty_parameter', ['%class%' => $class, '%method%' => $method, '%parameter%' => $parameter]);
    }
}
