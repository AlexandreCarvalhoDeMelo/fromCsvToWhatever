<?php
declare(strict_types=1);

namespace CastorCaster\Exceptions;

/**
 * Class ReaderClassNotFoundException
 *
 * @package CastorCaster\Exception
 */
class ReaderClassNotFoundException extends \Exception
{
    public const INVALID_FILE_LOCATION_ERROR = 'The reader (%s) class was not found. (maybe run "make dump")';
}