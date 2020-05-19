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
interface UrlResource extends IResource
{
    public function __construct($url);

    public function getBaseUrl(): string;

    public function get(): string;
}