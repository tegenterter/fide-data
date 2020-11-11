<?php

namespace FideData\Structure;

/**
 * Class Player
 * @package FideData\Structure
 */
class Player extends AbstractStructure
{
    /**
     * @var int
     */
    protected int $fideId;

    /**
     * @var string
     */
    protected ?string $name;

    /**
     * @var string
     */
    protected ?string $federation;

    /**
     * @var int
     */
    protected ?int $birthYear;

    /**
     * @var string
     */
    protected ?string $sex;

    /**
     * @var string
     */
    protected ?string $title;

    /**
     * @var Rating
     */
    protected ?Rating $standardRating;

    /**
     * @var Rating
     */
    protected ?Rating $rapidRating;

    /**
     * @var Rating
     */
    protected ?Rating $blitzRating;

    /**
     * @var bool
     */
    protected ?bool $active;

    /**
     * @param int $fideId
     */
    public function __construct(int $fideId)
    {
        $this->fideId = $fideId;
        $this->name = null;
        $this->federation = null;
        $this->birthYear = null;
        $this->sex = null;
        $this->title = null;
        $this->standardRating = null;
        $this->rapidRating = null;
        $this->blitzRating = null;
        $this->active = null;
    }

    /**
     * @return int
     */
    public function getFideId(): int
    {
        return $this->fideId;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFederation(): ?string
    {
        return $this->federation;
    }

    /**
     * @param string $federation
     */
    public function setFederation(string $federation): void
    {
        $this->federation = $federation;
    }

    /**
     * @return int
     */
    public function getBirthYear(): ?int
    {
        return $this->birthYear;
    }

    /**
     * @param int $birthYear
     */
    public function setBirthYear(int $birthYear): void
    {
        $this->birthYear = $birthYear;
    }

    /**
     * @return string
     */
    public function getSex(): ?string
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     */
    public function setSex(string $sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return Rating
     */
    public function getStandardRating(): ?Rating
    {
        return $this->standardRating;
    }

    /**
     * @param Rating $standardRating
     */
    public function setStandardRating(Rating $standardRating): void
    {
        $this->standardRating = $standardRating;
    }

    /**
     * @return Rating
     */
    public function getRapidRating(): ?Rating
    {
        return $this->rapidRating;
    }

    /**
     * @param Rating $rapidRating
     */
    public function setRapidRating(Rating $rapidRating): void
    {
        $this->rapidRating = $rapidRating;
    }

    /**
     * @return Rating
     */
    public function getBlitzRating(): ?Rating
    {
        return $this->blitzRating;
    }

    /**
     * @param Rating $blitzRating
     */
    public function setBlitzRating(Rating $blitzRating): void
    {
        $this->blitzRating = $blitzRating;
    }

    /**
     * @return bool
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $isActive
     */
    public function setActive(bool $isActive): void
    {
        $this->active = $isActive;
    }
}
