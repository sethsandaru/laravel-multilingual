<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/6/2019
 * Time: 11:00 PM
 */

namespace SethPhat\Multilingual\Libraries\Events;


use Illuminate\Queue\SerializesModels;
use SethPhat\Multilingual\Models\TextBundle;

/**
 * Class TextBundleCreated
 * @package SethPhat\Multilingual\libraries\events
 * This Event will be run after a new text bundle has been inserted
 */
class TextBundleCreated
{
	use SerializesModels;

	public $bundle;

	/**
	 * TextBundleCreated constructor.
	 * @param TextBundle $model
	 */
	public function __construct(TextBundle $model)
	{
		$this->bundle = $model;
	}
}