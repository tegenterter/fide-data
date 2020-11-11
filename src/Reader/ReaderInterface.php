<?php

namespace FideData\Reader;

use Generator;

/**
 * Interface ReaderInterface
 * @package FideData\Reader
 */
interface ReaderInterface
{
    /**
     * @return Generator
     */
    public function read(): Generator;
}
