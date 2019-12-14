<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/7/2019
 * Time: 10:51 AM
 */

namespace SethPhat\Multilingual\Libraries\Listeners;


use SethPhat\Multilingual\Libraries\Events\LanguageRemoved;
use SethPhat\Multilingual\Models\LangText;

class RemoveLangTextListener
{
	/**
	 * We need to delete all the record with the iso_code in lang_text
	 * @param LanguageRemoved $event
	 * @return void
	 */
	public function handle(LanguageRemoved $event) {
		LangText::query()->where('lang_code', $event->iso_code)->delete();
	}
}