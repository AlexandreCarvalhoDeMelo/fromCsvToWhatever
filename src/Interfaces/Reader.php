<?php
declare(strict_types=1);

namespace CastorCaster\Interfaces;

/**
 * Interface ConfigLoader
 *
 * @package CastorCaster\Interfaces
 */
interface Reader
{
    public function read(IResource $stream);
}