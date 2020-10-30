<?php

namespace classes;

final class CLIText
{
    /**
     * Changes the color of a given string
     *
     * @param string $str String
     * @param string $color Valid color:
     *    red, green, orange, blue, purple, cyan, yellow
     * @return string
     */
    public static function color($str, $color): string
    {
        $prefix = "\033[";
        switch ($color) {
            case 'red':
                $color_code = "31";
                break;
            case 'green':
                $color_code = "32";
                break;
            case 'orange':
                $color_code = "33";
                break;
            case 'blue':
                $color_code = "34";
                break;
            case 'purple':
                $color_code = "35";
                break;
            case 'cyan':
                $color_code = "36";
                break;
            case 'yellow':
                $color_code = "93";
                break;
        }
        $str = "${prefix}${color_code}m$str\033[0m";
        return $str;
    }

    /**
     * Bolds a given string
     *
     * @param string $str String
     * @return string
     */
    public static function bold($str): string
    {
        return "\033[1m$str\033[0m";
    }

    /**
     * Underlines a given string
     *
     * @param string $str String
     * @return string
     */
    public static function underline($str): string
    {
        return "\033[4m$str\033[0m";
    }
}
