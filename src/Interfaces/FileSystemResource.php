<?php
declare(strict_types=1);

namespace CastorCaster\Interfaces;

/**
 * FileSystemInput Interface
 * For dealing with file readOnly fs operations
 * Can be used for any type of file
 *
 * @package CastorCaster\Interfaces
 */
interface FileSystemResource extends IResource
{
    public function __construct($filePath);

    public function getName(): string;

    public function getMimeType(): string;

    public function getFileWithPath(): string;
}