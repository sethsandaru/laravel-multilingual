<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/7/2019
 * Time: 11:41 AM
 */

return [
	'title' => 'Text Bundle Management',

	// status text
	'translated-yes' => 'Yes',
	'translated-no' => 'No',

	// field-column
	'field-ID' => 'ID',
	'field-name' => 'Bundle Name',
	'field-description' => 'Description',
	'field-translated' => 'Translated?',
	'field-last-updated-at' => 'Last Updated At',

    // validation
    'name.required' => 'Bundle name is missing',
    'name.max' => 'Bundle name length can\'t be more than :max characters',
    'name.unique' => 'Bundle name must be UNIQUE in the system. Please consider to use another name.',

    // message
    'not-found' => 'Text bundle not found.',
    'delete-warning' => 'If you delete this text bundle, the process will delete all the items and it\'s language text. Are you still wish to continue?',
    'cache-is-turned-off' => 'Multilingual Cache Setting is turned off. Action aborted!',
];