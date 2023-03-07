<?php

namespace Asmodine\CommonBundle\Entity\Traits;

use Asmodine\CommonBundle\Util\Sugar;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait SoftDeleteableTrait.
 */
trait SoftDeleteableTrait
{
    /**
     * @var \DateTime
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * @return SoftDeleteableTrait
     */
    public function delete(): self
    {
        $this->deletedAt = Sugar::now();

        return $this;
    }

    /**
     * Is deleted?
     *
     * @return bool
     */
    public function isDeleted(): bool
    {
        return null !== $this->deletedAt;
    }
}
