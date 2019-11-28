<?php


namespace SethPhat\Multilingual\libraries;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\Translator;

class Helper
{
    /**
     * @var Replacement $replacement
     */
    protected static $replacement;

    /**
     * Get Text Bundle Item by Cache
     * @param $key
     * @param $module_name
     * @param $lang_code
     * @return string|null
     */
    public static function getFromCache($key, $module_name, $lang_code) {
        // KEY: "{key}_{module}_{lang}"
        $cache_key = "{$key}_{$module_name}_{$lang_code}";
        return Cache::get($cache_key);
    }

    /**
     * Replace Text
     * @param $text
     * @param array $replace_data
     */
    public static function replaceText($text, array $replace_data) {
        if (!isset(static::$replacement)) {
            static::$replacement = new Replacement(null, null);
        }

        return static::$replacement->replace($text, $replace_data);
    }

    /**
     * Get Lang Text from DB
     * @param $key
     * @param $module_name
     * @param $lang_code
     * @return string|null
     */
    public static function getLangTextFromDB($key, $module_name, $lang_code) {
        $data_obj = DB::table("text_bundle_items")
                        ->join("text_bundles", "text_bundles.id", "=", "text_bundle_items.text_bundle_id")
                        ->leftJoin("lang_texts", "lang_texts.text_id", "=", "text_bundle_items.text_id")
                        ->where('lang_texts.lang_code', $lang_code)
                        ->where('text_bundles.name', $module_name)
                        ->where('text_bundle_items.key', $key)
                        ->first('lang_texts.lang_text');

        return $data_obj->lang_text;
    }
}