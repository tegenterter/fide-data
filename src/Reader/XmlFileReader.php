<?php

namespace FideData\Reader;

use Generator;
use SimpleXMLElement;
use XMLReader;

/**
 * Class XmlFileReader
 * @package FideData\Reader
 */
class XmlFileReader implements ReaderInterface
{
    /**
     * @var string
     */
    protected string $path;

    /**
     * @var string
     */
    protected string $nodeName;

    /**
     * @param string $path
     * @param string $nodeName
     */
    public function __construct(string $path, string $nodeName)
    {
        $this->path = $path;
        $this->nodeName = $nodeName;
    }

    /**
     * @inheritDoc
     */
    public function read(): Generator
    {
        $reader = new XMLReader();
        $reader->open($this->path);

        while ($reader->read() && $reader->name !== $this->nodeName);

        while ($reader->name === $this->nodeName) {
            $node = new SimpleXMLElement($reader->readOuterXML());

            yield $node;

            $reader->next($this->nodeName);
        }

        $reader->close();
    }
}
