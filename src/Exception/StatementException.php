<?php

namespace Asmodine\CommonBundle\Exception;

use Asmodine\CommonBundle\Util\StringHelper;

/**
 * Class StatementException.
 */
class StatementException extends AbstractTranslateException
{
    /**
     * StatementException constructor.
     *
     * @param string          $sql
     * @param array           $parameters
     * @param \Exception|null $previous
     */
    public function __construct(string $sql, array $parameters, \Exception $previous = null)
    {
        parent::__construct('statement', ['%sql%' => $sql, '%parameters%' => StringHelper::arrayToString($parameters, true)], [], 0, $previous);
    }
}
