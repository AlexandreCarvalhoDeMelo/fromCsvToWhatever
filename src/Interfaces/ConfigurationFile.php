<?php
declare(strict_types=1);

namespace CastorCaster\Interfaces;

/**
 * Interface ConfigurationFile
 * Json resource interface, gives us a one-way into dealing with different types
 * of files without many complications
 *
 * @package CastorCaster\Interfaces
 */
interface ConfigurationFile
{

    /**
     * ConfigLoader constructor.
     *
     * @param  string $configFilePath
     * @return self
     */
    public function load($configFilePath): self;

    /**
     * @param  $key
     * @return mixed
     */
    public function get(string $key);

}