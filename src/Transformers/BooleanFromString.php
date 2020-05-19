<?php
declare(strict_types=1);

namespace CastorCaster\Transformers;

use CastorCaster\Exceptions\InvalidTransformationException;
use CastorCaster\Interfaces\Transformer;

class BooleanFromString implements Transformer
{

    /**
     * @param  string $string
     * @param  array  $params
     * @return mixed
     * @throws InvalidTransformationException
     */
    public function transform(string $string, array $params)
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
     * @param  array $params
     * @return bool
     */
    public function isTransformerConfigurationValid(array $params): bool
    {
        $requiredOptionsBeenInformed = ((isset($params[0], $params[1])));

        $requiredOptionsAreEqual = $params[0] === $params[1];

        if (!$requiredOptionsBeenInformed || $requiredOptionsAreEqual) {
            return false;
        }

        return true;
    }
}