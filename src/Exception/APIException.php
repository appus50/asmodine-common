<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class APIException.
 */
class APIException extends AbstractTranslateException
{
    /**
     * APIException constructor.
     *
     * @param string $url
     * @param string $method
     * @param int    $statusCode
     */
    public function __construct(string $url, string $method, int $statusCode)
    {
        parent::__construct('api', ['%url%' => $url, '%method%' => $method, '%status_code%' => $statusCode]);
    }
}
