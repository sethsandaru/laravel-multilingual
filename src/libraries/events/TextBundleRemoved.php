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
 * Class TextBundleRemoved
 * @package SethPhat\Multilingual\libraries\events
 * This Event will be run after a text bundle has been deleted
 */
class TextBundleRemoved
{
	use SerializesModels;

	public $bundle;

	/**
	 * TextBundleCreated constructor.
	 * @param array $model
	 */
	public function __construct(array $bundle_data)
	{
		$this->bundle = $bundle_data;
	}
}