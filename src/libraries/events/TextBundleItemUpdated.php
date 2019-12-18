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
 * Class TextBundleItemUpdated
 * @package SethPhat\Multilingual\libraries\events
 * This Event will be run after a new text bundle has been inserted
 */
class TextBundleItemUpdated
{
	use SerializesModels;

	public $bundle_item;

	/**
	 * TextBundleItemUpdated constructor.
	 * @param TextBundleItem $model
	 */
	public function __construct(TextBundleItem $model)
	{
		$this->bundle_item = $model;
	}
}