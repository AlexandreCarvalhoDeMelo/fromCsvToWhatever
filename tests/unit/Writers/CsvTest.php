<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Writers;

use CastorCaster\Tests\TestCase;
use CastorCaster\Writers\Csv;

class CsvTest extends TestCase
{

    /**
     * @return array
     */
    public function outputProvider(): array
    {
        return [
            'valid output' => [
                [
                    ['id', 'name', 'age'],
                    ['1', 'john doe', '44'],
                    ['2', 'jany doe', '46']
                ],
            ]
        ];
    }

    public function tearDown()
    {
        if (file_exists(self::PROD_OUTPUT_FILE_NAME_WITH_EXTENSION)) {
            unlink(self::PROD_OUTPUT_FILE_NAME_WITH_EXTENSION);
        }

        if (file_exists(self::TEST_OUTPUT_FILE_NAME_WITH_EXTENSION)) {
            unlink(self::TEST_OUTPUT_FILE_NAME_WITH_EXTENSION);
        }
    }

    /**
     * @dataProvider outputProvider
     * @param $output
     */
    public function test_can_write_file(array $output): void
    {
        $writerType = new Csv(self::TEST_OUTPUT_FILE_NAME);
        $writerType->write($output);

        self::assertFileExists(self::TEST_OUTPUT_FILE_NAME_WITH_EXTENSION);
    }

    /**
     * @dataProvider outputProvider
     * @param $output
     */
    public function test_if_csv_file_content_is_valid(array $output): void
    {
        $writerType = new Csv(self::TEST_OUTPUT_FILE_NAME);
        $writerType->write($output);

        $expectedResult = <<<CSV
id;name;age
1;"john doe";44
2;"jany doe";46

CSV;
        self::assertStringEqualsFile(self::TEST_OUTPUT_FILE_NAME_WITH_EXTENSION, $expectedResult);
    }

    /**
     * @dataProvider outputProvider
     * @param $output
     */
    public function test_if_can_create_files_with_default_and_custom_names(array $output): void
    {
        (new Csv())->write(
            $output
        );

        (new Csv(self::TEST_OUTPUT_FILE_NAME))->write(
            $output
        );

        $this->assertFileExists(self::PROD_OUTPUT_FILE_NAME_WITH_EXTENSION);
        $this->assertFileExists(self::TEST_OUTPUT_FILE_NAME_WITH_EXTENSION);

    }
}