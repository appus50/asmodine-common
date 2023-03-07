<?php

namespace Asmodine\CommonBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait EnableTrait.
 */
trait EnableTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(name="is_activated_manually", type="boolean", nullable=true)
     */
    private $activeManual = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="activated_manually_at", type="datetime", nullable=true)
     */
    private $activeManualAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_activated_automatically", type="boolean", options={"default" : false})
     */
    private $activeAuto = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="activated_automatically_at", type="datetime", nullable=true)
     */
    private $activeAutoAt;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return ($this->activeManual ?? true) && $this->activeAuto;
    }

    /**
     * Enable Entity.
     *
     * @return $this
     */
    public function enable(): self
    {
        if (null === $this->activeManual || !$this->activeManual) {
            $this->activeManualAt = new \DateTime();
        }
        $this->activeManual = true;

        return $this;
    }

    /**
     * Disable Entity.
     *
     * @return $this
     */
    public function disable(): self
    {
        if (null === $this->activeManual || $this->activeManual) {
            $this->activeManualAt = new \DateTime();
        }
        $this->activeManual = false;

        return $this;
    }
}
