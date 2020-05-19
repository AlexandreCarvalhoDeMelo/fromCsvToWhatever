<?php
declare(strict_types=1);

namespace CastorCaster\Writers;

use CastorCaster\Interfaces\Writer;

class Csv implements Writer
{
    public const FILE_NAME = 'output.csv';
    public const FILE_EXTENSION = '.csv';
    public const SUCCESS_MESSAGE = 'The output.csv file was writen';

    /**
     * @var string
     */
    protected $fileName;

    public function __construct(?string $fileName = null)
    {
        $this->fileName = self::FILE_NAME;
        if($fileName) {
            $this->fileName = $fileName.self::FILE_EXTENSION;
        }
    }

    /**
     * @param $output
     */
    public function write($output): void
    {
        $fp = fopen($this->fileName, 'w');

        foreach ($output as $fields) {
            fputcsv($fp, $fields, ';');
        }

        fclose($fp);

        echo self::SUCCESS_MESSAGE . PHP_EOL;
    }
}

