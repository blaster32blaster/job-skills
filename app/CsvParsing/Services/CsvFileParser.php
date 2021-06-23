<?php

namespace App\CsvParsing\Services;

use App\CsvParsing\Services\CsvFileParser as ServicesCsvFileParser;
use Illuminate\Support\Collection;

/**
 * parse a csv file
 */
class CsvFileParser
{
    /**
     * the file path
     *
     * @var string $file
     */
    protected $file;

    /**
     * the parsing options
     *
     * @var array $options
     */
    protected $options;

    public function __construct(string $csvFile, array $options)
    {
        $this->file = $csvFile;
        $this->options = $options;
    }

    /**
     * set up needed data for parsing
     *
     * @param string $csvFile  the filepath
     * @param array $options  parsing options
     * @return ServicesCsvFileParser $this
     */
    public static function init(string $csvFile, array $options) : ServicesCsvFileParser
    {
        return new self($csvFile, $options);
    }

    /**
     * parse the csv file
     * this assumes the first row is headers
     *
     * @return array
     */
    public function run() : array
    {
        $file_handle = fopen($this->file, 'r');
        while (!feof($file_handle)) {
            $text[] = fgetcsv($file_handle, 0, $this->options['delimiter']);
        }
        fclose($file_handle);

        return [
            'headers' => $this->fetchColumnHeaders($text),
            'data' => $this->fetchData($text)
        ];
    }

    /**
     * get the parsed data
     *
     * @param array $text
     * @return Collection the parsed data
     */
    protected function fetchData(array $text) : Collection
    {
        unset($text[0]);
        return collect(array_values($text));
    }

    /**
     * the column headers
     *
     * @param array $text
     * @return array the column headers
     */
    protected function fetchColumnHeaders(array $text) : array
    {
        return $text[0];
    }
}
