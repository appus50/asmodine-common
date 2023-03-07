<?php

namespace Asmodine\CommonBundle\Util;

/**
 * Class Sugar.
 */
class Sugar
{
    /**
     * @return \DateTime
     */
    public static function now(): \DateTime
    {
        try {
            return new \DateTime();
        } catch (\Exception $exception) {
            // Never
        }

        return null;
    }
}
