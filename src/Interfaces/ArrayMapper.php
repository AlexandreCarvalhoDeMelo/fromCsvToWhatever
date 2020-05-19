<?php

namespace CastorCaster\Interfaces;

/**
 * Interface Mapper
 *
 * @package CastorCaster\Interfaces
 */
interface ArrayMapper extends Mapper
{
    public function __construct(array $content, array $fields);

    public function process(): array;
}