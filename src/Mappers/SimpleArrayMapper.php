<?php
declare(strict_types=1);

namespace CastorCaster\Mappers;

use CastorCaster\Interfaces\ArrayMapper;
use CastorCaster\Interfaces\Transformer;

class SimpleArrayMapper implements ArrayMapper
{
    /**
     * too much responsibility : /, could be improved but using a DI container
     */
    const TRANSFORMERS_NAMESPACE = '\\CastorCaster\\Transformers\\';
    /**
     * Mapping definitions
     *
     * @var array $mapping
     */
    protected $mapping;
    /**
     * Response array first column aka header
     *
     * @var array $headers
     */
    protected $headers;
    /**
     * Content sent by the reader
     *
     * @var array $rows
     */
    protected $rows;
    /**
     * @var array need to re-create instances during whole file
     */
    protected $transformerLocalCache = [];

    /**
     * Mapping constructor.
     *
     * @param $content
     * @param $mapping
     */
    public function __construct(array $content, array $mapping)
    {
        $this->mapping = $mapping;
        $this->rows = $content;
    }

    /**
     * @return array
     */
    public function process(): array
    {
        $processedRows = [];
        $rows = $this->rows;
        $rowScheme = $this->assembleMappingRowScheme($rows);
        array_shift($rows);
        $processedRows[0] = $this->headers;

        $rowCounter = 1;

        foreach ($rows as $row) {
            $cellCounter = 0;
            foreach ($row as $cell) {

                if (!isset($rowScheme[$cellCounter])) {
                    $cellCounter++;
                    continue;
                }

                $transformers = $rowScheme[$cellCounter]['transformers'] ?? [];

                if (!empty($transformers) && !empty($cell)) {
                    $cell = $this->applyTransformers($cell, $transformers);
                }

                $processedRows[$rowCounter][$rowScheme[$cellCounter]['position']] = $cell;
                ksort($processedRows[$rowCounter]);
                $cellCounter++;
            }

            $rowCounter++;
        }

        return $processedRows;
    }

    /**
     * @param  $content
     * @return array
     */
    protected function assembleMappingRowScheme($content): array
    {
        $rowScheme = [];
        $headers = $content[0];
        $keyToMap = 0;
        foreach ($this->mapping as $mappingKey => $mapping) {
            $this->headers[] = $mappingKey;
            $columnIndex = 0;
            foreach ($headers as $fileHeaderName) {

                $fieldToSearch = $mapping['field'] ?? $mapping;
                if ($fieldToSearch === $fileHeaderName) {
                    break;
                }
                $columnIndex++;
            }

            $rowScheme[$columnIndex] = [
                'position' => $keyToMap,
                'key' => $mappingKey,
                'transformers' => $mapping['transformers'] ?? []
            ];
            $keyToMap++;
        }


        return $rowScheme;
    }

    /**
     * @param string $value
     * @param array $transformers
     * @return mixed
     */
    protected function applyTransformers(string $value, array $transformers)
    {
        foreach ($transformers as $transformer => $transformerParams) {

            if (isset($this->transformerLocalCache[$transformer])) {
                $transformerClass = $this->transformerLocalCache[$transformer];
            } else {
                $transformerClass = $this->assembleTransformerClassName($transformer);
                $transformerClass = new $transformerClass();
                $this->transformerLocalCache[$transformer] = $transformerClass;
            }

            /**
             * @var Transformer $transformerClass
             */
            $value = $transformerClass->transform($value, $transformerParams);
        }

        return $value;
    }

    /**
     * @param string $transformerConfigName
     * @return string
     */
    protected function assembleTransformerClassName(string $transformerConfigName): string
    {
        //Sorry for the black magic : (
        return self::TRANSFORMERS_NAMESPACE .
            str_replace('_', '', ucwords($transformerConfigName, '_'));
    }
}