<?php
declare(strict_types=1);

namespace CastorCaster\Writers;

use CastorCaster\Interfaces\Writer;

/**
 * Class Html
 *
 * @package CastorCaster\Writers
 */
class Html implements Writer
{
    public const FILE_NAME = 'output.html';
    public const SUCCESS_MESSAGE = 'The output.html file was writen';

    /**
     * @param  $output
     * @return mixed|void
     */
    public function write($output): void
    {
        $htmlValid = '<!DOCTYPE html> <html lang="en"> <head> <meta charset="utf-8"> <title>output</title></head> <body> %s </body> </html>';
        $html = "<table>";
        foreach ($output as $row) {
            $html .= "<tr>";
            foreach ($row as $cell) {
                $html .= "<td>" . $cell . "</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";

        $fullHtml = sprintf($htmlValid, $html);
        $file = fopen(self::FILE_NAME, "w");
        fwrite($file, $fullHtml);
        fclose($file);

        echo self::SUCCESS_MESSAGE . PHP_EOL;
    }
}

