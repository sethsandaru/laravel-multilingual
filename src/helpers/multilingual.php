<?php

/**
 * Main Helper Function for the Package
 */

if (!function_exists('multilingual')) {
	/**
	 * Get translation text
	 * @param string $key Key Value of Text Bundle Item
	 * @param string $module_name Text Bundle Name
	 * @param array $replace_text
	 * @param string|null $specific_language ISO Lang Code - Should be as same as the Languages table value. Default is the current language
	 * @param boolean $should_throw
	 * @throws \RuntimeException if text module item not found and $should_throw is TRUE
	 * @return string
	 */
	function multilingual($key = null, $module_name = null, $replace_text = [], $specific_language = null, $should_throw = true) {
	    if (func_num_args() == 0) {
	        return app('multilingual');
        }

	    // get translation text
		return app('multilingual')->get($key, $module_name, $replace_text, $specific_language, $should_throw);
	}
}