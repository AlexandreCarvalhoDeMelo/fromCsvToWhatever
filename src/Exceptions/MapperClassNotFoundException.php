<?php
declare(strict_types=1);

namespace CastorCaster\Exceptions;

/**
 * Class MapperClassNotFoundException
 *
 * @package CastorCaster\Exception
 */
class MapperClassNotFoundException extends \Exception
{
    public const INVALID_FILE_LOCATION_ERROR = 'The mapper (%s) class was not found. (maybe run "make dump")';
}