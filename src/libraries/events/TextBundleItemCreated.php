<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/6/2019
 * Time: 11:00 PM
 */

namespace SethPhat\Multilingual\Libraries\Events;


use Illuminate\Queue\SerializesModels;
use SethPhat\Multilingual\Models\TextBundleItem;

/**
 * Class TextBundleItemCreated
 * @package SethPhat\Multilingual\libraries\events
 * This Event will be run after a new text bundle has been inserted
 */
class TextBundleItemCreated
{
	use SerializesModels;

	public $bundle_item;

	/**
	 * TextBundleItemCreated constructor.
	 * @param TextBundleItem $model
	 */
	public function __construct(TextBundleItem $model)
	{
		$this->bundle_item = $model;
	}
}