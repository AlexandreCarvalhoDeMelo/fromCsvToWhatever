<?php
require_once 'vendor/autoload.php';
date_default_timezone_set('UTC');

/**
 * @author Alexandre Carvalho de Melo <alexandre.carvalho.melo@gmail.com>
 * CastorCaster - A stream transformer with a inferiority complex : )
 * @see: Symfony commands could do that backed by a framework
 * But here we're trying to go PHP-PURE approach.
 *
 *
 * @Todo: Implement factory pattern, get namespaces from composer
 * @Todo: Implement locks system allowing concurrent writing
 * @Todo: needs BOM and spreasheet delimiter configs
 */
use CastorCaster\Resources\ConfigurationJson as ConfigFile;
use CastorCaster\Resources\FileSystem as FileSystemLoader;
use CastorCaster\Resources\Url as UrlLoader;
use CastorCaster\Interfaces\Mapper;
use CastorCaster\Interfaces\Reader;
use CastorCaster\Interfaces\Writer;
use CastorCaster\Exceptions\MapperClassNotFoundException;
use CastorCaster\Exceptions\ReaderClassNotFoundException;
use CastorCaster\Exceptions\WriterClassNotFoundException;
/**
 * Config file path
 * Which types should be allowed?
 * Which the max filesize accepted?
 * All sorts of configurations regarding the input file
 *
 * @var string
 */
$inputConfigPath = 'config/system.json';


/**
 * Mapping config path
 * This file is used to read mapping configurations for the api
 * It's the one responsible for determining which field is mapped and transformations applied
 *
 * @var String
 */
$inputMappingConfigPath = 'config/mapping.json';


/**
 * Readers and Writers
 * I know that specifying namespaces like that is not very good
 * But i think it's better here, the inside the json config file
 * @todo load namespaces from composer (JUST TESTING HERE SO FAR)
 */
$readerClassesNamespace = '\\CastorCaster\\Readers\\';
$writerClassesNamespace = '\\CastorCaster\\Writers\\';
$mapperClassesNamespace = '\\CastorCaster\\Mappers\\';


/**
 * Input sent by cli args
 *
 * @Todo: use symfony-cli-args
 * @var string
 */
$input = $argv[1] ?? '';


/**
 * Loading everything
 */
try {

    $mappingConfig = (new ConfigFile())->load($inputMappingConfigPath);
    $systemConfig = (new ConfigFile())->load($inputConfigPath);

    $isInputAValidFile = is_file($input);
    $input = $isInputAValidFile ? new FileSystemLoader($input) : new UrlLoader($input);

    /**
     * Just testing quick transformation
     *
     * @todo: Remove this from foreach and implement factory pattern by mimeType.
     */
    foreach ($systemConfig->get('readers') as $readerClass => $readerClassProperties) {
        $foundInputMimeType = in_array($input->getMimeType(), $readerClassProperties['mime_types'], true);

        if ($foundInputMimeType) {
            $readerClass = $readerClassesNamespace . $readerClass;

            $mapperClass = $mapperClassesNamespace .
                ($readerClassProperties['mapper'] ?? $systemConfig->get('options')['default_mapper']);

            $writerClass = $writerClassesNamespace .
                ($readerClassProperties['writer'] ?? $systemConfig->get('options')['default_writer']);

            $classesToValidate = [
                $readerClass => ReaderClassNotFoundException::class,
                $mapperClass => MapperClassNotFoundException::class,
                $writerClass => WriterClassNotFoundException::class,
            ];

            foreach ($classesToValidate as $class => $exception) {

                if (!class_exists($class)) {
                    $message = sprintf($class::INVALID_FILE_LOCATION_ERROR, $class);
                    throw new $classesToValidate[$class]($message);
                }
            }

            /**
             * the reader has one responsibility, which is transform
             * from the file format given to the format expected by the mapper
             *
             * @var Reader $readerType
             */
            $readerType = new $readerClass();
            $content = $readerType->read($input);

            /**
             * Our Simple array mapper is responsible for all kinds of transformation
             *
             * @var Mapper $mapperType
             */
            $mapperType = new $mapperClass($content, $mappingConfig->getAll());
            $output = $mapperType->process();

            /**
             * Once processed and returned the output is taken by the writer
             * which is capable of iterating, mapping, transforming and serving data
             *
             * @var Writer $writerType
             */
            $writerType = new $writerClass;
            return $writerType->write($output);
        }
    }

} catch (Exception $e) {
    $oldSchoolErrorMsg = "\e[0;31;42mSoftware Failure. {$e->getMessage()}\e[0m\n";
    echo $oldSchoolErrorMsg;
}
