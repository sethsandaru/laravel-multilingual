<?php


namespace SethPhat\Multilingual\Libraries;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Translation\Translator;

class Replacement
{
    /**
     * Replace Text
     *      Like Laravel Translation
     * @param $text
     * @param array $data
     * @return string
     */
    public function replace($text, array $data) {
        return $this->makeReplacements($text, $data);
    }
    /**
     * Make the place-holder replacements on a line.
     *
     * @param  string  $line
     * @param  array   $replace
     * @return string
     */
    protected function makeReplacements($line, array $replace)
    {
        if (empty($replace)) {
            return $line;
        }

        $replace = $this->sortReplacements($replace);

        foreach ($replace as $key => $value) {
            $line = str_replace(
                [':'.$key, ':'.Str::upper($key), ':'.Str::ucfirst($key)],
                [$value, Str::upper($value), Str::ucfirst($value)],
                $line
            );
        }

        return $line;
    }

    /**
     * Sort the replacements array.
     *
     * @param  array  $replace
     * @return array
     */
    protected function sortReplacements(array $replace)
    {
        return (new Collection($replace))->sortBy(function ($value, $key) {
            return mb_strlen($key) * -1;
        })->all();
    }
}