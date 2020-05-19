<?php
declare(strict_types=1);

namespace CastorCaster\Transformers;

use CastorCaster\Exceptions\InvalidTransformationException;
use CastorCaster\Interfaces\Transformer;

class ReplaceString implements Transformer
{
    /**
     * @param  string $string
     * @param  array  $params
     * @return string
     * @throws InvalidTransformationException
     */
    public function transform(string $string, array $params): string
    {
        if (!$this->isTransformerConfigurationValid($params)) {
            throw new InvalidTransformationException(
                self::class . ' transformer got wrong configuration options'
            );
        }

        return \str_replace($params['search'], $params['replace'], $string);
    }

    /**
     * @param  array $params
     * @return bool
     */
    public function isTransformerConfigurationValid(array $params): bool
    {
        $requiredOptionsBeenInformed = (isset($params['search'], $params['replace']));

        if (!$requiredOptionsBeenInformed) {
            return false;
        }

        return true;
    }
}