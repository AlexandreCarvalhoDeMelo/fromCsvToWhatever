<?php
declare(strict_types=1);

namespace CastorCaster\Readers;

use CastorCaster\Interfaces\IResource;
use CastorCaster\Interfaces\Reader;

class HttpCsv implements Reader
{
    /**
     * Just a simple sample of easiness of behaviour extension
     *
     * @see https://pastebin.com/raw/5WpWRzt5
     * For testing purposes
     * @try php caster.php https://pastebin.com/raw/5WpWRzt5
     *
     * @param  IResource $url
     * @return mixed
     */
    public function read(IResource $url): array
    {
        $csv = [];
        $data = file_get_contents($url->get());
        $rows = explode("\n", $data);
        foreach ($rows as $row) {
            $csv[] = str_getcsv($row, ';');
        }

        return $csv;
    }
}

