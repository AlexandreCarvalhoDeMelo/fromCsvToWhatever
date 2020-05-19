<?php
declare(strict_types=1);

namespace CastorCaster\Resources;

use CastorCaster\Exceptions\InvalidInputFileException;
use CastorCaster\Interfaces\FileSystemResource;

/**
 * Class InputFileSystemLoader
 *
 * @package CastorCaster\Resources
 */
class FileSystem extends \SplFileInfo implements FileSystemResource
{
    /**
     * @param  mixed $inputFilePath
     * @throws InvalidInputFileException
     */
    public function __construct($inputFilePath)
    {
        $file = realpath($inputFilePath);

        if (!$file) {
            throw new InvalidInputFileException(InvalidInputFileException::INVALID_INPUT_ERROR);
        }

        parent::__construct($file);
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        return $finfo->file($this->getFileWithPath());
    }

    /**
     * @return string
     */
    public function getFileWithPath(): string
    {
        return $this->getPathname();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getBasename();
    }
}