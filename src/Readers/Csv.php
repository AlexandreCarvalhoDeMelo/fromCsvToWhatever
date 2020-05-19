<?php
declare(strict_types=1);

namespace CastorCaster\Readers;

use CastorCaster\Interfaces\IResource;
use CastorCaster\Interfaces\Reader;

class Csv implements Reader
{
    public function read(IResource $input): array
    {
        $csvFile = file($input->getFileWithPath());

        $rows = [];
        foreach ($csvFile as $line) {
            $rows[] = str_getcsv($line, ';');
        }
        return $rows;
    }
}

