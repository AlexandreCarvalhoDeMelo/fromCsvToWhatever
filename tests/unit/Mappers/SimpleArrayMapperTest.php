<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Mappers;

use CastorCaster\Mappers\SimpleArrayMapper;

class SimpleArrayMapperTest extends \CastorCaster\Tests\TestCase
{
    /**
     * @return array
     */
    public function mapperProvider(): array
    {
        return [
            'mapper data' => [
                'readerContent' => [
                    ['ID_NUM', 'FIRST_NAME', 'AGE'],
                    ['1', 'john', '44'],
                    ['2', 'jane', '46'],
                ],
                'mapping' => [
                    'id' => 'ID_NUM',
                    'age' => 'AGE',
                    'name' => 'FIRST_NAME',
                ],
                'expected' => [
                    ['id', 'age', 'name'],
                    ['1', '44', 'john'],
                    ['2', '46', 'jane'],
                ]
            ]
        ];
    }

    /**
     * @dataProvider mapperProvider
     * @param $readerContent
     * @param $mapping
     * @param $expected
     */
    public function test_it_can_map_arrays($readerContent, $mapping, $expected)
    {
        $subject = (new SimpleArrayMapper($readerContent, $mapping))->process();

        self::assertEquals($expected, $subject);
    }

}