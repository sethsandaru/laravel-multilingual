<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/6/2019
 * Time: 11:23 PM
 */

namespace SethPhat\Multilingual\libraries\events;


use Illuminate\Queue\SerializesModels;

/**
 * Class LanguageRemoved
 * @package SethPhat\Multilingual\libraries\events
 * This event will be run after a record language removed
 */
class LanguageRemoved
{
	use SerializesModels;

	public $iso_code;

	/**
	 * LanguageCreated constructor.
	 * @param string $lang_iso_code
	 */
	public function __construct(string $lang_iso_code)
	{
		$this->iso_code = $lang_iso_code;
	}
}