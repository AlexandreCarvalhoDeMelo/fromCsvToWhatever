<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Transformers;

use CastorCaster\Tests\TestCase;

class NumberFromString extends TestCase
{
    /**
     * @return array
     */
    public function numberFromStringProvider(): array
    {
        return [
            'transform in numbers' => [
                'value' => 'six',
                'params' => [
                    '6' => 'six',
                ],
                'expected' => '6'
            ]
        ];
    }


    /**
     * @dataProvider numberFromStringProvider
     * @param $value
     * @param $params
     * @param $expected
     * @throws \CastorCaster\Exceptions\InvalidTransformationException
     */
    public function test_replace_number($value, $params, $expected)
    {
        $calc = new \CastorCaster\Transformers\NumberFromString();
        $result = $calc->transform((string)$value, $params);
        self::assertEquals($expected, $result);
    }
}