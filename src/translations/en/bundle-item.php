<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/13/2019
 * Time: 11:08 PM
 */

return [
    'title' => 'Text Bundle Item Management',


    // fields
    'field-ID' => 'ID',
    'field-key' => 'Key',
    'field-text' => 'Text',
    'field-description' => 'Description',
    'field-translated' => 'Translated?',
    'field-last-updated' => 'Last Updated',
    'field-text-bundle' => 'Text Bundle',

    // message/note
    'field-select-a-bundle' => 'Select a text bundle',

    // filter
    'filter-text-bundle' => 'Only Text Bundle',
    'filter-lang-text-type' => 'Show Language Text',

    // some default text
    'all-bundle' => 'All Bundle',
    'current-language' => 'Current Language (Code: :lang)',

    // validation
    'key.required' => 'Text Key is missing',
    'key.max' => 'Text Key length can\'t be more than :max characters',
    'key.unique' => 'Text Key must be UNIQUE in the Bundle. Please consider to use another name.',

    'text_bundle_id.required' => 'Text Bundle must be selected',
    'text_bundle_id.exists' => 'Text Bundle you chose doesn\'t existed in your database. Please try again.',

];