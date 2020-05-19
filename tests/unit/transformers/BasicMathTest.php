<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Transformers;

use CastorCaster\Tests\TestCase;
use CastorCaster\Transformers\BasicMath;

class BasicMathTest extends TestCase
{
    /**
     * @return array
     */
    public function mathProvider(): array
    {
        return [
            '*' => [
                'value' => 10,
                'params' => [
                    'operation' => 'multiply',
                    'factor' => 5,
                ],
                'expected' => 50
            ],
            '/' => [
                'value' => 10,
                'params' => [
                    'operation' => 'divide',
                    'factor' => 5,
                ],
                'expected' => 2
            ],
            '+' => [
                'value' => 10,
                'params' => [
                    'operation' => 'add',
                    'factor' => 5,
                ],
                'expected' => 15
            ],
            '-' => [
                'value' => 10,
                'params' => [
                    'operation' => 'subtract',
                    'factor' => 5,
                ],
                'expected' => 5
            ],
        ];
    }


    /**
     * @dataProvider mathProvider
     * @param $value
     * @param $params
     * @param $expected
     * @throws \CastorCaster\Exceptions\InvalidTransformationException
     */
    public function test_multiply_operation($value, $params, $expected)
    {
        $calc = new BasicMath();
        $result = $calc->transform((string)$value, $params);
        self::assertEquals($expected, $result);
    }
}