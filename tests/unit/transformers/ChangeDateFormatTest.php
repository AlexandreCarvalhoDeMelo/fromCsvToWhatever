<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Transformers;

use CastorCaster\Tests\TestCase;
use CastorCaster\Transformers\ChangeDateFormat;

class ChangeDateFormatTest extends TestCase
{
    /**
     * @return array
     */
    public function dateProvider(): array
    {
        return [
            'format_changer' => [
                'value' => '02-03-20',
                'params' => [
                    'from' => 'd-m-y',
                    'to' => 'Y-m-d',
                ],
                'expected' => '2020-03-02'
            ]
        ];
    }


    /**
     * @dataProvider dateProvider
     * @param $value
     * @param $params
     * @param $expected
     * @throws \CastorCaster\Exceptions\InvalidTransformationException
     */
    public function test_replace_string($value, $params, $expected)
    {
        $calc = new ChangeDateFormat();
        $result = $calc->transform((string)$value, $params);
        self::assertEquals($expected, $result);
    }
}