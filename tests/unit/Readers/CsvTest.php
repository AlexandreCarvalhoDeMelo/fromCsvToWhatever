<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Readers;

use CastorCaster\Readers\Csv;
use CastorCaster\Resources\FileSystem;
use CastorCaster\Tests\TestCase;

class CsvTest extends TestCase
{
    public function test_read_file(): void
    {
        $writerType = new Csv();
        $file = new FileSystem(self::TEST_INPUT_FILE_FIXTURE);
        $content = $writerType->read($file);

        self::assertIsArray($content);
    }

    public function test_find_csv_header(): void
    {
        $writerType = new Csv();
        $file = new FileSystem(self::TEST_INPUT_FILE_FIXTURE);
        $content = $writerType->read($file);

        self::assertIsNotNumeric($content[0][0]);
        self::assertIsNotNumeric($content[0][1]);
        self::assertIsNotNumeric($content[0][2]);
    }

}