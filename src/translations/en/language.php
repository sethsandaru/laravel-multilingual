<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/3/2019
 * Time: 10:36 PM
 */

return [
    'title' => 'Language Management',

    // search form
    'search' => 'Search',
    'search-by-keyword' => 'Search by Keyword',

    // table columns
    'table-column-code' => 'Language ISO Code',
    'table-column-name' => 'Language name',
    'table-column-last-updated' => 'Last updated',
    'table-column-actions' => 'Actions',

    // message
    'no-result' => 'No result found.',

	// validation message
	'lang_iso_code.required' => 'Language ISO Code is missing',
	'lang_iso_code.min' => 'Language ISO Code minimum length is :min',
	'lang_iso_code.max' => 'Language ISO Code maximum length is :max',
	'lang_iso_code.unique' => 'Language ISO Code must be UNIQUE. A language with the same ISO Code is already existed',

	'name.required' => 'Language Name is missing',
	'name.max' => 'Language Name maximum length is :max',
];