<?php

namespace App\Entity;

use App\Repository\DefaultParamRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DefaultParamRepository::class)
 */
class DefaultParam
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $avgBreath;

    /**
     * @ORM\Column(type="integer")
     */
    private $speedFalling;

    /**
     * @ORM\Column(type="integer")
     */
    private $speedRisingBeforeBearing;

    /**
     * @ORM\Column(type="integer")
     */
    private $speedRisingBetweenBearing;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvgBreath(): ?int
    {
        return $this->avgBreath;
    }

    public function setAvgBreath(int $avgBreath): self
    {
        $this->avgBreath = $avgBreath;

        return $this;
    }

    public function getSpeedFalling(): ?int
    {
        return $this->speedFalling;
    }

    public function setSpeedFalling(int $speedFalling): self
    {
        $this->speedFalling = $speedFalling;

        return $this;
    }

    public function getSpeedRisingBeforeBearing(): ?int
    {
        return $this->speedRisingBeforeBearing;
    }

    public function setSpeedRisingBeforeBearing(int $speedRisingBeforeBearing): self
    {
        $this->speedRisingBeforeBearing = $speedRisingBeforeBearing;

        return $this;
    }

    public function getSpeedRisingBetweenBearing(): ?int
    {
        return $this->speedRisingBetweenBearing;
    }

    public function setSpeedRisingBetweenBearing(int $speedRisingBetweenBearing): self
    {
        $this->speedRisingBetweenBearing = $speedRisingBetweenBearing;

        return $this;
    }
}
