<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class EnumParameterException.
 */
class EnumParameterException extends AbstractTranslateException
{
    /**
     * EnumParameterException constructor.
     *
     * @param string $argument
     * @param array  $validArguments
     */
    public function __construct(string $argument, array $validArguments)
    {
        parent::__construct('enum_parameter', ['%parameter%' => $argument, '%valid_parameters%' => implode(', ', $validArguments)]);
    }
}
