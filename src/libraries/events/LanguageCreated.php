<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/6/2019
 * Time: 11:00 PM
 */

namespace SethPhat\Multilingual\Libraries\Events;


use Illuminate\Queue\SerializesModels;
use SethPhat\Multilingual\Models\Language;

/**
 * Class LanguageCreated
 * @package SethPhat\Multilingual\libraries\events
 * This Event will be run after a new language model inserted
 */
class LanguageCreated
{
	use SerializesModels;

	public $language;

	/**
	 * LanguageCreated constructor.
	 * @param Language $model
	 */
	public function __construct(Language $model)
	{
		$this->language = $model;
	}
}