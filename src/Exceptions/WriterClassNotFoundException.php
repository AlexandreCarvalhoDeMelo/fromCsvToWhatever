<?php
declare(strict_types=1);

namespace CastorCaster\Exceptions;

/**
 * Class WriterClassNotFoundException
 *
 * @package CastorCaster\Exception
 */
class WriterClassNotFoundException extends \Exception
{
    public const INVALID_FILE_LOCATION_ERROR = 'The writer (%s) class was not found. (maybe run "make dump")';
}