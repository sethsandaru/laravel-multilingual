<?php


namespace SethPhat\Multilingual\Libraries;


use Illuminate\Translation\Translator;

class Replacement extends Translator
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
}