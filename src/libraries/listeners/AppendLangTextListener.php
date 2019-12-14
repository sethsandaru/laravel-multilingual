<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/7/2019
 * Time: 10:44 AM
 */

namespace SethPhat\Multilingual\libraries\listeners;

use SethPhat\Multilingual\Libraries\Events\LanguageCreated;
use SethPhat\Multilingual\models\LangText;

class AppendLangTextListener
{
	/**
	 * So we need to create more langtext record for the new language user just created
	 * @param LanguageCreated $event
	 */
	public function handle(LanguageCreated $event)
	{
		$lang_iso_code = $event->language->lang_iso_code;

		// get all the current lang_text
		$text_models = LangText::query()->select(['text_id'])->distinct()->get();

		// create all of them.
		foreach ($text_models as $lang_text) {
			// we can only access text_id
			LangText::create([
				'text_id' => $lang_text->text_id,
				'lang_code' => $lang_iso_code,
				'lang_text' => ''
			]);
		}

		// done :D
	}
}