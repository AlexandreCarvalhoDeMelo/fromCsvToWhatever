<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Transformers;

use CastorCaster\Tests\TestCase;
use CastorCaster\Transformers\ReplaceString;

class ReplaceStringTest extends TestCase
{
    /**
     * @return array
     */
    public function replaceProvider(): array
    {
        return [
            'replacer' => [
                'value' => 'ip: 127.0.0.1',
                'params' => [
                    'search' => 'ip: ',
                    'replace' => '',
                ],
                'expected' => '127.0.0.1'
            ]
        ];
    }


    /**
     * @dataProvider replaceProvider
     * @param $value
     * @param $params
     * @param $expected
     * @throws \CastorCaster\Exceptions\InvalidTransformationException
     */
    public function test_replace_string($value, $params, $expected)
    {
        $calc = new ReplaceString();
        $result = $calc->transform((string)$value, $params);
        self::assertEquals($expected, $result);
    }
}