<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/3/2019
 * Time: 10:36 PM
 */

return [
    'title' => 'Quản lý ngôn ngữ',

    // search form
    'search' => 'Tìm kiếm',
    'search-by-keyword' => 'Tìm theo từ khóa',

    // table columns
    'table-column-code' => 'ISO Code của Ngôn ngữ',
    'table-column-name' => 'Tên ngôn ngữ',
    'table-column-last-updated' => 'Lần cuối được chỉnh sửa',
    'table-column-actions' => 'Hành động',

    // message
    'no-result' => 'Không có kết quả nào',

	// validation message
	'lang_iso_code.required' => 'ISO Code của Ngôn ngữ còn trống',
	'lang_iso_code.min' => 'ISO Code của Ngôn ngữ tối thiểu là :min ký tự',
	'lang_iso_code.max' => 'ISO Code của Ngôn ngữ tối đa là :max ký tự',
	'lang_iso_code.unique' => 'ISO Code của Ngôn ngữ đã tồn tại. Xin hãy dùng ISO Code khác',

	'name.required' => 'Tên ngôn ngữ còn trống',
	'name.max' => 'Tên ngôn ngữ tối đa là :max ký tự',
];