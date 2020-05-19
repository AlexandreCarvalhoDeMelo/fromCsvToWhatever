<?php
declare(strict_types=1);

namespace CastorCaster\Exceptions;

/**
 * Class InvalidConfigFileException
 *
 * @package CastorCaster\Exception
 */
class InvalidConfigFileException extends \Exception
{
    public const INVALID_FILE_LOCATION_ERROR = 'Configuration file not found.';
    public const INVALID_FILE_TYPE_ERROR = 'Configuration %s file is invalid.';
}