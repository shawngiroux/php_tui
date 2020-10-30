<?php

namespace classes;

use Exception;

final class CliTable
{
    private array $headers = [];
    private array $rows = [];

    /**
     * Sets the header for the table
     *
     * @param array $headers Flat array of column names
     * @return void
     */
    public function setHeader(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * Adds row to table data
     *
     * @param array $rows Row of data keyed with the column header
     * @return void
     */
    public function addRow(array $row): void
    {
        $this->rows[] = $row;
    }

    /**
     * Draws table
     * @return void
     */
    public function draw(): void
    {
        $column_padding = [];
        $table_data = [];
        $table_data[] = array_combine($this->headers, $this->headers);

        // Couple things are happening here:
        // 1) Getting each column's largest padding
        // 2) Setting the table data variable
        foreach ($this->rows as $row) {
            $table_data_row = [];
            foreach ($row as $header => $value) {
                // Check that header is valid
                if (!in_array($header, $this->headers)) {
                    throw new Exception("$header header does not exist in headers array");
                }

                // Init padding
                if (!isset($column_padding[$header])) {
                    $column_padding[$header] = strlen($header);
                }

                $largest_str = $column_padding[$header];
                $str_length = strlen($value);

                // Compensating for color codes
                if (preg_match("/\\033.+?m/", $value, $matches)) {
                    $str_length -= strlen($matches[0]) + 4;
                }


                if ($str_length > $largest_str) {
                    $column_padding[$header] = $str_length;
                }

                $table_data_row[$header] = $value;
            }
            $table_data[] = $table_data_row;
        }

        // Generating delimiter
        $delimiter = "";
        foreach ($column_padding as $pad_length) {
            $output_str = sprintf("+%s", str_pad("", $pad_length + 2, "-", STR_PAD_LEFT));
            $delimiter .= $output_str;
        }
        $delimiter .= "+";

        // Drawing table
        echo $delimiter, PHP_EOL;
        foreach ($table_data as $row) {
            $output = "";
            foreach ($row as $header => $value) {
                $pad_length = $column_padding[$header];

                // Compensating for color codes
                if (preg_match("/\\033.+?m/", $value, $matches)) {
                    $pad_length += strlen($matches[0]) + 4;
                }

                $output_str = sprintf("| %s ", str_pad($value, $pad_length, " ", STR_PAD_RIGHT));
                $output .= $output_str;
            }
            echo "$output|", PHP_EOL;
            echo $delimiter, PHP_EOL;
        }
    }
}
