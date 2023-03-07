<?php

namespace Asmodine\CommonBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait AssociationTrait.
 */
trait AssociationTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(name="is_associated_automatically", type="boolean", options={"default" : false})
     */
    private $associateAuto = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="associated_manually_at", type="datetime", nullable=true)
     */
    private $associateManualAt;
}
