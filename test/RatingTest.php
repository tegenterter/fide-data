<?php

declare(strict_types=1);

use FideData\Enum\RatingType;
use FideData\Enum\Sex;
use FideData\Enum\Title;
use FideData\PlayerRating;
use FideData\Structure\Player;
use FideData\Structure\Rating;
use PHPUnit\Framework\TestCase;

/**
 * Class RatingTest
 */
final class RatingTest extends TestCase
{
    public function testKasparov(): void
    {
        $rating = new PlayerRating(__DIR__ . '/data/kasparov.xml');

        /** @var Player $player */
        foreach ($rating->process() as $player) {
            $this->assertInstanceOf(Player::class, $player);
            $this->assertEquals(4100018, $player->getFideId());
            $this->assertEquals('Kasparov, Garry', $player->getName());
            $this->assertEquals(1963, $player->getBirthYear());
            $this->assertEquals(Title::GRANDMASTER, $player->getTitle());
            $this->assertEquals('RUS', $player->getFederation());
            $this->assertEquals(Sex::MALE, $player->getSex());
            $this->assertFalse($player->isActive());

            $this->assertInstanceOf(Rating::class, $player->getStandardRating());
            $this->assertEquals(RatingType::STANDARD, $player->getStandardRating()->getType());
            $this->assertEquals(10, $player->getStandardRating()->getK());
            $this->assertEquals(2812, $player->getStandardRating()->getRating());

            $this->assertInstanceOf(Rating::class, $player->getRapidRating());
            $this->assertEquals(RatingType::RAPID, $player->getRapidRating()->getType());
            $this->assertEquals(20, $player->getRapidRating()->getK());
            $this->assertEquals(2783, $player->getRapidRating()->getRating());

            $this->assertInstanceOf(Rating::class, $player->getBlitzRating());
            $this->assertEquals(RatingType::BLITZ, $player->getBlitzRating()->getType());
            $this->assertEquals(20, $player->getBlitzRating()->getK());
            $this->assertEquals(2801, $player->getBlitzRating()->getRating());
        }
    }

    public function testInvalidFile(): void
    {
        $rating = new PlayerRating(__DIR__ . '/data/invalid.xml');

        /** @var Exception $exception */
        foreach ($rating->process() as $exception) {
            $this->assertInstanceOf(Exception::class, $exception);
            $this->assertNotEmpty($exception->getMessage());
        }
    }
}
