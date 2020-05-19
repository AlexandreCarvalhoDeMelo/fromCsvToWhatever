<?php

namespace CastorCaster\Tests;

abstract class  TestCase extends \PHPUnit\Framework\TestCase
{
    const PROD_OUTPUT_FILE_NAME = 'output';
    const PROD_OUTPUT_FILE_NAME_WITH_EXTENSION = 'output.csv';
    const TEST_CONFIGURATION_FILE_FIXTURE = 'tests/fixtures/system_test.json';
    const TEST_MAPPING_FILE_INTEGRATION_FIXTURE = 'tests/fixtures/mapping_integration_test.json';
    const TEST_INPUT_FILE_INTEGRATION_FIXTURE = 'tests/fixtures/input_integration_test.csv';
    const TEST_INPUT_FILE_FIXTURE = 'tests/fixtures/input_test.csv';
    const TEST_OUTPUT_FILE_NAME = 'test_output';
    const TEST_OUTPUT_FILE_NAME_WITH_EXTENSION = 'test_output.csv';

}