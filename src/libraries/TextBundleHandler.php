<?php


namespace SethPhat\Multilingual\Libraries;

use Illuminate\Support\Facades\App;

class TextBundleHandler
{
    /**
     * Get translation text
     * @param string $key Key Value of Text Bundle Item
     * @param string $module_name Text Bundle Name
     * @param array $replace_text
     * @param string|null $specific_language ISO Lang Code - Should be as same as the Languages table value. Default is the current language
     * @param boolean $should_throw
     * @throws \RuntimeException if text module item not found
     * @return string
     */
    public function get($key, $module_name, $replace_text = [], $specific_language = null, $should_throw = true) {
        $lang_code = App::getLocale();

        if (!empty($specific_language)) {
            # TODO: Need to check this language doesn't exists on the system
            $lang_code = $specific_language;
        }

        // PREPARE TO GET TEXT
        $lang_text = null;
        if (config('multilingual.use_cache') === true) {
            // GET LANG_TEXT FROM CACHE
            $lang_text = Helper::getFromCache($key, $module_name, $lang_code);
        } else {
            // GET LANG_TEXT FROM DB
            $lang_text = Helper::getLangTextFromDB($key, $module_name, $lang_code);
        }

        // error handling...
        if ($lang_text === null) {
            $err_mess = "Text Bundle Item {$key} doesn't existed in {$module_name} or you haven't published the bundle yet.";

            // return immediately
            if ($should_throw) {
                throw new \RuntimeException($err_mess);
            } else {
                return $err_mess;
            }
        }

        // REPLACE TEXT IF EXISTS
        if (!empty($replace_text)) {
            // replace text here
            $lang_text = Helper::replaceText($lang_text, $replace_text);
        }

        // Last thing here
        return $lang_text;
    }
}