<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class NotImplementedException.
 */
class NotImplementedException extends AbstractTranslateException
{
    /**
     * NotImplementedException constructor.
     *
     * @param string $class
     * @param string $method
     */
    public function __construct(string $class, string $method)
    {
        parent::__construct('not_implemented', ['%class%' => $class, '%method%' => $method]);
    }
}
