<?php

namespace FideData\Enum;

use ReflectionClass;
use ReflectionException;

/**
 * Class AbstractEnum
 * @package FideData\Enum
 */
abstract class AbstractEnum
{
    /**
     * @return string[]
     * @throws ReflectionException
     */
    public static function getValues(): array
    {
        $reflectionClass = new ReflectionClass(get_called_class());

        return $reflectionClass->getConstants();
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function validate(string $value): bool
    {
        try {
            return in_array($value, self::getValues());
        } catch (ReflectionException $exception) {
            return false;
        }
    }
}
