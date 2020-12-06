<h1 align="center"><img src="fide.png" alt="FIDE" width="390" height="250"></h1>

**Library for processing open data published by [FIDE](https://www.fide.com) for [PHP](https://php.net)**

[![Build Status](https://travis-ci.org/tegenterter/fide-data.svg?branch=master)](https://travis-ci.org/tegenterter/fide-data)

## Features

- Parse and normalize [player rating XML files](https://ratings.fide.com/download_lists.phtml)

## Documentation

### Installation

Use [Composer](https://getcomposer.org) to install the library for your project:

    composer require tegenterter/fide-data
    
### Basic Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// Downloading particular rating file from https://ratings.fide.com/download_lists.phtml
$client = new \FideData\Http\RatingXmlDownloader(__DIR__);
$path = $client->download(\FideData\Enum\RatingType::STANDARD, 2020, 12);

// Read and parse the rating file
$rating = new \FideData\PlayerRating($path);

/** @var \FideData\Structure\Player $player */
foreach ($rating->process() as $player) {
    // Get array representation of the player object
    $array = $player->toArray();

    echo json_encode($array, JSON_PRETTY_PRINT) . PHP_EOL;
    /**
    {
        "fideId": 1503014,
        "name": "Carlsen, Magnus",
        "federation": "NOR",
        "birthYear": 1990,
        "sex": "M",
        "title": "GM",
        "standardRating": {
            "type": "standard",
            "rating": 2862,
            "k": 10
        },
        "rapidRating": null,
        "blitzRating": null,
        "active": false
    } 
    */
}
```

### Testing

The library is covered by unit tests using [PHPUnit](https://phpunit.de). You can use the following [Composer](https://getcomposer.org) script to run them:

    composer run test
