<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class CatalogException.
 */
class CatalogException extends AbstractTranslateException
{
    /**
     * CatalogException constructor.
     *
     * @param string $message           'catalog.???'
     * @param array  $messageParameters
     */
    public function __construct(string $message, array $messageParameters = [])
    {
        parent::__construct($message, $messageParameters);
        if (0 !== strpos($message, 'catalog.')) {
            throw new ReachException();
        }
    }
}
