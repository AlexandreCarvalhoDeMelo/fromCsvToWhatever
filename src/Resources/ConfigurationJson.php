<?php
declare(strict_types=1);

namespace CastorCaster\Resources;

use CastorCaster\Exceptions\InvalidConfigFileException;
use CastorCaster\Interfaces\ConfigurationFile;

/**
 * Class ConfigurationJson
 * Wrapper for using json files as config
 * Could be ini, or yaml, you decide it!
 *
 * Yes, a little insecure about these class names i.i
 *
 * @package CastorCaster\Resources
 */
class ConfigurationJson implements ConfigurationFile
{
    protected $data = null;

    /**
     * @param  string $configFilePath
     * @return ConfigurationFile
     * @throws InvalidConfigFileException
     */
    public function load($configFilePath): ConfigurationFile
    {
        if (!is_file($configFilePath)) {
            throw new InvalidConfigFileException(InvalidConfigFileException::INVALID_FILE_LOCATION_ERROR);
        }

        $file = realpath($configFilePath);
        $this->data = \json_decode(\file_get_contents($file), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidConfigFileException(sprintf(InvalidConfigFileException::INVALID_FILE_TYPE_ERROR, $file));
        }

        return $this;
    }

    /**
     * @param  string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->data[$key] ?? null;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->data ?? [];
    }

}