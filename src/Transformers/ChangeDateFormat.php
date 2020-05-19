<?php
declare(strict_types=1);

namespace CastorCaster\Transformers;

use CastorCaster\Exceptions\InvalidTransformationException;
use CastorCaster\Interfaces\Transformer;

class ChangeDateFormat implements Transformer
{

    protected $date;

    /**
     * @param  string $data
     * @param  array  $params
     * @return string
     * @throws InvalidTransformationException
     */
    public function transform(string $data, array $params): string
    {
        if (!$this->isTransformerConfigurationValid($params)) {
            throw new InvalidTransformationException(
                self::class . ' transformer got wrong configuration options'
            );
        }

        $date = \DateTime::createFromFormat($params['from'], $data);

        if (!$date) {
            throw new InvalidTransformationException('Invalid from date format');
        }

        return $date->format($params['to']);
    }

    /**
     * @param  array $params
     * @return bool
     */
    public function isTransformerConfigurationValid(array $params): bool
    {
        $requiredOptionsNotCreated = !isset($params['from'], $params['to']);
        $requiredOptionsAreEqual = $params['from'] === $params['to'];

        if ($requiredOptionsAreEqual || $requiredOptionsNotCreated) {
            return false;
        }

        return true;
    }
}