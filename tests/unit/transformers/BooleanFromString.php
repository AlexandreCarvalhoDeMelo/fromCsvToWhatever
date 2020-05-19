<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Transformers;

use CastorCaster\Tests\TestCase;

class BooleanFromString extends TestCase
{
    /**
     * @return array
     */
    public function BooleanFromStringProvider(): array
    {
        return [
            'transform in numbers' => [
                'value' => 'on',
                'params' => [
                    '0' => 'off',
                    '1' => 'on',
                ],
                'expected' => 1
            ]
        ];
    }


    /**
     * @dataProvider BooleanFromStringProvider
     * @param $value
     * @param $params
     * @param $expected
     * @throws \CastorCaster\Exceptions\InvalidTransformationException
     */
    public function test_replace_string($value, $params, $expected)
    {
        $calc = new \CastorCaster\Transformers\NumberFromString();
        $result = $calc->transform((string)$value, $params);
        self::assertEquals($expected, $result);
    }
}