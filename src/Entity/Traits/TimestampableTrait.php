<?php

namespace Asmodine\CommonBundle\Entity\Traits;

use Asmodine\CommonBundle\Util\Sugar;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TimestampableTrait.
 *
 * @ORM\HasLifecycleCallbacks()
 */
trait TimestampableTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * Triggered on insert.
     *
     * @ORM\PrePersist
     */
    public function onPrePersist(): self
    {
        $this->createdAt = Sugar::now();
        $this->updatedAt = Sugar::now();

        return $this;
    }

    /**
     * Triggered on update.
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate(): self
    {
        $this->updatedAt = Sugar::now();

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt ?? Sugar::now();
    }
}
