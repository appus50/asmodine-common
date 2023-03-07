<?php

namespace Asmodine\CommonBundle\Domain;

/**
 * Interface SluggableInterface.
 */
interface SluggableInterface
{
    /**
     * Get all slugs;.
     *
     * @return array
     */
    public static function getSlugs(): array;

    /**
     * @param string|null $slug
     *
     * @return bool
     */
    public static function checkSlug(?string $slug): void;
}
