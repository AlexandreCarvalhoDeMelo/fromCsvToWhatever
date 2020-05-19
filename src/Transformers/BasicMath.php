<?php
declare(strict_types=1);

namespace CastorCaster\Transformers;

use CastorCaster\Exceptions\InvalidTransformationException;
use CastorCaster\Interfaces\Transformer;

/**
 * Class BasicMath
 *
 * @package CastorCaster\Transformers
 */
class BasicMath implements Transformer
{

    /**
     * This could be done a 1000 ways
     * Not using eval is always nice!
     */
    public const VALID_OPERATIONS = [
        'multiply',
        'add',
        'divide',
        'subtract'
    ];

    /**
     * @var
     */
    protected $factor;
    protected $value;

    /**
     * @param  string $string
     * @param  array  $params
     * @return string
     * @throws InvalidTransformationException
     */
    public function transform(string $string, array $params)
    {
        if (!is_numeric($string)) {
            throw new InvalidTransformationException(
                self::class . ' transformer should transform from numeric value'
            );
        }

        if (!$this->isTransformerConfigurationValid($params)) {
            throw new InvalidTransformationException(
                self::class . ' transformer got wrong configuration options'
            );
        }

        $this->value = $string;
        $this->factor = $params['factor'];
        $operation = $params['operation'];

        return $this->$operation();
    }

    /**
     * @param  array $params
     * @return bool
     */
    public function isTransformerConfigurationValid(array $params): bool
    {
        $requiredOptionsBeenInformed = (isset($params['operation'], $params['factor']));
        $requiredOptionFactorIsANumber = is_numeric($params['factor']) && $params['factor'] !== '0';
        $requiredOptionOperationExists = in_array($params['operation'], self::VALID_OPERATIONS, true);

        if (!$requiredOptionsBeenInformed || !$requiredOptionFactorIsANumber || !$requiredOptionOperationExists) {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    protected function add()
    {
        return ($this->value + $this->factor);
    }

    /**
     * @return float|int
     */
    protected function multiply()
    {
        return ($this->factor * $this->value);
    }

    /**
     * @return mixed
     */
    protected function subtract()
    {
        return ($this->value - $this->factor);
    }

    /**
     * @return float|int
     */
    protected function divide()
    {
        return ($this->value / $this->factor);
    }
}