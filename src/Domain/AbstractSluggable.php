<?php

namespace Asmodine\CommonBundle\Domain;

use Asmodine\CommonBundle\Exception\EnumParameterException;
use Asmodine\CommonBundle\Exception\NullParameterException;

/**
 * Class AbstractSluggable.
 */
abstract class AbstractSluggable implements SluggableInterface
{
    /**
     * @param string|null $slug
     *
     * @throws EnumParameterException
     * @throws NullParameterException
     */
    public static function checkSlug(?string $slug): void
    {
        /** @var SluggableInterface $class */
        $class = \get_called_class();
        if (null === $slug) {
            throw new NullParameterException($class, 'checkSlug', '$slug');
        }
        if (!\in_array($slug, $class::getSlugs(), true)) {
            throw new EnumParameterException($slug, $class::getSlugs());
        }
    }
}
