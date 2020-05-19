<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Integration;

use CastorCaster\Mappers\SimpleArrayMapper;
use CastorCaster\Readers\Csv as CsvReader;
use CastorCaster\Resources\FileSystem;
use CastorCaster\Writers\Csv as CsvWriter;
use CastorCaster\Tests\TestCase;
use CastorCaster\Resources\ConfigurationJson as ConfigFile;

class FromCsvToCsvWithTransformers extends TestCase
{

    public function test_full_cycle()
    {

        $expectedResult = <<<CSV
id;name;store_credit;discount_alert;last_login
1;Joe;805;1;2020-03-13
2;John;1005;0;2020-03-07
3;Jim;655;0;2020-03-12


CSV;

        $mappingConfig = (new ConfigFile())->load(self::TEST_MAPPING_FILE_INTEGRATION_FIXTURE);

        $input = (new FileSystem(self::TEST_INPUT_FILE_INTEGRATION_FIXTURE));

        $readerType = new CsvReader();
        $content = $readerType->read($input);

        $mapperType = new SimpleArrayMapper($content, $mappingConfig->getAll());
        $output = $mapperType->process();

        $writerType = new CsvWriter('tests/fixtures/test_output/output');
        $writerType->write($output);

        self::assertStringEqualsFile( 'tests/fixtures/test_output/output.csv', $expectedResult);
    }
}
