<h1 align="center"><img src="fide.png" alt="FIDE" width="390" height="250"></h1>

**Library for processing open data published by [FIDE](https://www.fide.com) for [PHP](https://php.net)**

## Features

- Parse and normalize [player rating XML files](https://ratings.fide.com/download_lists.phtml)

## Documentation

### Installation

Use [Composer](https://getcomposer.org) to install the library for your project:

    composer require tegenter/fide-data
    
### Basic Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// Pass any XML rating file downloaded from https://ratings.fide.com/download_lists.phtml
$rating = new \FideData\PlayerRating('players_list_xml_foa.xml');

/** @var \FideData\Structure\Player $player */
foreach ($rating->process() as $player) {
    // Get array representation of the player object
    $array = $player->toArray();

    echo json_encode($array, JSON_PRETTY_PRINT) . PHP_EOL;
}
```

### Testing

The library is covered by unit tests using [PHPUnit](https://phpunit.de). You can use the following [Composer](https://getcomposer.org) script to run them:

    composer run test
