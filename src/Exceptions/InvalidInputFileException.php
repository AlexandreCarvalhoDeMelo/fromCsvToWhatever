<?php
declare(strict_types=1);

namespace CastorCaster\Exceptions;

/**
 * Class InvalidInputFileException
 *
 * @package CastorCaster\Exception
 */
class InvalidInputFileException extends \Exception
{
    public const INVALID_INPUT_ERROR = 'The given input is not a file.';
}