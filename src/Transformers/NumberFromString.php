<?php
declare(strict_types=1);

namespace CastorCaster\Transformers;

use CastorCaster\Exceptions\InvalidTransformationException;
use CastorCaster\Interfaces\Transformer;

class NumberFromString implements Transformer
{
    /**
     * @param  string $string
     * @param  array  $params
     * @return int
     * @throws InvalidTransformationException
     */
    public function transform(string $string, array $params): int
    {
        if (!$this->isTransformerConfigurationValid($params)) {
            throw new InvalidTransformationException(
                self::class . ' transformer got wrong configuration options'
            );
        }

        $configuredOptionsToBooleans = array_flip($params);

        return $configuredOptionsToBooleans[$string];
    }


    /**
     * Validates config looking for 0 and 1 as keys
     *
     * A little bit a safety measure
     * we could consider this transformation working with one
     * parameter such as x = 0, thus everything else is 1, this is a bit
     * risky so let's also define what's we expect from 1
     *
     * @param  array $params
     * @return bool
     * @throws InvalidTransformationException
     */
    public function isTransformerConfigurationValid(array $params): bool
    {
        $requiredOptionsContainsAtLeastOneOption = count($params) > 0;

        $requiredOptionsKeysAreNumbers = true;
        foreach ($params as $optionKey => $optionValue) {
            if (!is_numeric($optionKey)) {
                $requiredOptionsKeysAreNumbers = false;
                break;
            }
        }

        $options = array_values($params);
        $requiredOptionsAreNotRepeated = count($options) === count(array_unique($options));

        if (!$requiredOptionsContainsAtLeastOneOption
            || !$requiredOptionsKeysAreNumbers
            || !$requiredOptionsAreNotRepeated
        ) {
            return false;
        }

        return true;
    }
}