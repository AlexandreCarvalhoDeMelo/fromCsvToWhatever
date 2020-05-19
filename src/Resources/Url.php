<?php
declare(strict_types=1);

namespace CastorCaster\Resources;

use CastorCaster\Exceptions\InvalidInputFileException;
use CastorCaster\Interfaces\UrlResource;

/**
 * Class Url
 *
 * @package CastorCaster\Resources
 */
class Url implements UrlResource
{

    protected $url;

    /**
     * @param  string $url
     * @throws InvalidInputFileException
     */
    public function __construct($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidInputFileException(InvalidInputFileException::INVALID_INPUT_ERROR);
        }

        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return 'text/html';
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return \parse_url($this->url, PHP_URL_HOST);
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->url;
    }
}