<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class BadPropertyException.
 */
class BadPropertyException extends AbstractTranslateException
{
    /**
     * BadPropertyException constructor.
     *
     * @param string $class
     * @param string $property
     */
    public function __construct(string $class, string $property)
    {
        parent::__construct('bad_property', ['%class%' => $class, '%property%' => $property]);
    }
}
