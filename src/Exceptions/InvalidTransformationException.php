<?php
declare(strict_types=1);

namespace CastorCaster\Exceptions;

/**
 * Class InvalidTransformationException
 *
 * @package CastorCaster\Exception
 */
class InvalidTransformationException extends \Exception
{
    public const INVALID_FILE_LOCATION_ERROR = "This transformation can't be performed %s";
}