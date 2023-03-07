<?php

namespace Asmodine\CommonBundle\Exception;

/**
 * Class ReachException.
 */
class ReachException extends AbstractTranslateException
{
    /**
     * ReachException constructor.
     */
    public function __construct()
    {
        parent::__construct('reach');
    }
}
