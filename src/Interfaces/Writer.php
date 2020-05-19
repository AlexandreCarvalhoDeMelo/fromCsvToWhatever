<?php
declare(strict_types=1);

namespace CastorCaster\Interfaces;

/**
 * Interface ConfigLoader
 *
 * @package CastorCaster\Interfaces
 */
interface Writer
{

    /**
     * @param  $content
     * @return mixed
     */
    public function write($content): void;
}