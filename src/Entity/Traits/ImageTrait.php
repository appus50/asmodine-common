<?php

namespace Asmodine\CommonBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait ImageTrait.
 */
trait ImageTrait
{
    use EnableTrait;
    use TimestampableTrait;
    use SoftDeleteableTrait;

    /**
     * @var string
     * @ORM\Column(name="initial_link", type="string", length=511)
     */
    private $initialLink;

    /**
     * @var string
     * @ORM\Column(name="local_link", type="string", length=511, nullable=true)
     */
    private $localLink;

    /**
     * @var int
     * @ORM\Column(name="position", type="smallint", length=3, nullable=true)
     */
    private $position;

    /**
     * @var bool
     * @ORM\Column(name="is_downloaded", type="boolean", options={"default" : false})
     */
    private $download;
}
