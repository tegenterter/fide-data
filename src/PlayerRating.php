<?php

namespace FideData;

use FideData\Enum\Flag;
use FideData\Enum\RatingType;
use FideData\Enum\Sex;
use FideData\Enum\Title;
use FideData\Reader\ReaderInterface;
use FideData\Reader\XmlFileReader;
use FideData\Structure\Player;
use Generator;
use RuntimeException;
use SimpleXMLElement;

/**
 * Class PlayerRating
 * @package FideData
 */
class PlayerRating
{
    /**
     * @var ReaderInterface
     */
    protected ReaderInterface $reader;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->reader = new XmlFileReader($path, 'player');
    }

    /**
     * @return Generator
     */
    public function process(): Generator
    {
        /** @var SimpleXMLElement $element */
        foreach ($this->reader->read() as $element) {
            $fideId = (int) $element->fideid;

            if ($fideId > 0) {
                $player = new Player($fideId);

                $standardRating = (int) $element->rating;

                if ($standardRating > 0) {
                    $player->setStandardRating(
                        new Structure\Rating(
                            RatingType::STANDARD,
                            $standardRating,
                            (int) $element->k
                        )
                    );
                }

                $rapidRating = (int) $element->rapid_rating;

                if ($rapidRating > 0) {
                    $player->setRapidRating(
                        new Structure\Rating(
                            RatingType::RAPID,
                            $rapidRating,
                            (int) $element->rapid_k
                        )
                    );
                }

                $blitzRating = (int) $element->blitz_rating;

                if ($blitzRating > 0) {
                    $player->setBlitzRating(
                        new Structure\Rating(
                            RatingType::BLITZ,
                            $blitzRating,
                            (int) $element->blitz_k
                        )
                    );
                }

                $player->setName(trim((string) $element->name));
                $player->setFederation((string) $element->country);

                $birthYear = (int) $element->birthday;

                if ($birthYear > 0) {
                    $player->setBirthYear($birthYear);
                }

                $title = (string) $element->title;

                if (!empty($title) && Title::validate($title)) {
                    $player->setTitle($title);
                }

                $sex = (string) $element->sex;

                if (Sex::validate($sex)) {
                    $player->setSex($sex);
                }

                $flag = (string) $element->flag;
                $player->setActive($flag !== Flag::INACTIVE && $flag !== Flag::WOMAN_INACTIVE);

                yield $player;
            } else {
                yield new RuntimeException("Invalid FIDE ID");
            }
        }
    }
}
