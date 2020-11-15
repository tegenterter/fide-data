<?php

namespace FideData\Http;

use FideData\Enum\Month;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;
use ZipArchive;

/**
 * Class RatingXmlDownloader
 * @package FideData\Http
 */
class RatingXmlDownloader
{
    /**
     * @var string
     */
    protected string $destination;

    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @param string $destination Location where to store the downloaded file
     * @param int $timeout HTTP request timeout in seconds
     */
    public function __construct(string $destination, int $timeout = 30)
    {
        $this->destination = $destination;
        $this->client = new Client([
            'base_uri' => 'http://ratings.fide.com/download/',
            'timeout' => $timeout,
        ]);
    }

    /**
     * @param string $ratingType
     * @param int $year
     * @param int $month
     * @return string
     * @throws RuntimeException
     */
    public function download(string $ratingType, int $year, int $month): string
    {
        $basename = sprintf(
            '%s_%s%dfrl_xml',
            $ratingType,
            $this->getMonthIdentifier($month),
            substr($year, 2)
        );

        $filename = "$basename.zip";

        try {
            $this->client->get($filename, [
                'sink' => $filename,
            ]);

            $archive = new ZipArchive();

            if ($archive->open($filename) === true) {
                $unarchived = $archive->extractTo($this->destination);
                $archive->close();

                // Remove ZIP file
                unlink($filename);

                $path = sprintf('%s/%s.xml', rtrim($this->destination, '/'), $basename);

                if ($unarchived !== true || !is_file($path)) {
                    throw new RuntimeException("Failed to extract ZIP archive");
                }

                return $path;
            }
        } catch (GuzzleException $exception) {
            throw new RuntimeException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param int $month
     * @return string
     */
    protected function getMonthIdentifier(int $month): string
    {
        $map = [
            Month::JANUARY => 'jan',
            Month::FEBRUARY => 'feb',
            Month::MARCH => 'mar',
            Month::APRIL => 'apr',
            Month::MAY => 'may',
            Month::JUNE => 'jun',
            Month::JULY => 'jul',
            Month::AUGUST => 'aug',
            Month::SEPTEMBER => 'sep',
            Month::OCTOBER => 'oct',
            Month::NOVEMBER => 'nov',
            Month::DECEMBER => 'dec',
        ];

        return $map[$month];
    }
}
