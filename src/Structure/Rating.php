<?php

namespace FideData\Structure;

/**
 * Class PlayerRating
 * @package FideData\Structure
 */
class Rating extends AbstractStructure
{
    /**
     * @var string
     */
    protected string $type;

    /**
     * @var int
     */
    protected int $rating;

    /**
     * @var int
     */
    protected int $k;

    /**
     * @param string $type
     * @param int $rating
     * @param int $k
     */
    public function __construct(string $type, int $rating, int $k)
    {
        $this->type = $type;
        $this->rating = $rating;
        $this->k = $k;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @return int
     */
    public function getK(): int
    {
        return $this->k;
    }
}
