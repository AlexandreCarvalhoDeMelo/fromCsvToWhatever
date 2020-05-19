<?php
declare(strict_types=1);

namespace CastorCaster\Interfaces;


/**
 * Interface Mapper
 *
 * @package CastorCaster\Interfaces
 */
interface Transformer
{

    /**
     * Data is subject to transformation
     *
     * @param string $data
     * @param array  $params
     */
    public function transform(string $data, array $params);

    /**
     * @param  array $params
     * @return bool
     */
    public function isTransformerConfigurationValid(array $params): bool;
}