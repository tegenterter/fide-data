<?php

namespace FideData\Structure;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * Class AbstractStructure
 * @package FideData\Structure
 */
abstract class AbstractStructure
{
    /**
     * @return array<string,mixed>
     * @throws ReflectionException
     */
    public function toArray(): array
    {
        $reflectionClass = new ReflectionClass($this);
        $reflectionProperties = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);

        $values = [];

        foreach ($reflectionProperties as $reflectionProperty) {
            $value = $this->{$reflectionProperty->getName()};

            if ($value instanceof self) {
                $value = $value->toArray();
            }

            $values[$reflectionProperty->getName()] = $value;
        }

        return $values;
    }
}
