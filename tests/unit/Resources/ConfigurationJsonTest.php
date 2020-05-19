<?php
declare(strict_types=1);

namespace CastorCaster\Tests\Unit\Resources;

use CastorCaster\Resources\ConfigurationJson;
use CastorCaster\Tests\TestCase;

class ConfigurationJsonTest extends TestCase
{
    public function test_read_json(): void
    {
        $expectedJson = json_decode(file_get_contents(self::TEST_CONFIGURATION_FILE_FIXTURE), true);

        $configuration = (new ConfigurationJson())->load(
            self::TEST_CONFIGURATION_FILE_FIXTURE
        );

        self::assertEquals($expectedJson, $configuration->getAll());
    }

    public function test_json_can_access_headers(): void
    {
        $expectedJson = json_decode(file_get_contents(self::TEST_CONFIGURATION_FILE_FIXTURE), true);

        $configuration = (new ConfigurationJson())->load(
            self::TEST_CONFIGURATION_FILE_FIXTURE
        );

        foreach ($expectedJson as $expectedKey => $expectedValue){
            self::assertNotEmpty($configuration->get($expectedKey));
        }
    }
}