<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/7/2019
 * Time: 11:41 AM
 */

return [
	'title' => 'Quản lý gói từ ngữ',

	// status text
	'translated-yes' => 'Đã dịch',
	'translated-no' => 'Chưa dịch',

	// field-column
	'field-ID' => 'ID',
	'field-name' => 'Tên gói',
	'field-description' => 'Mô tả',
	'field-translated' => 'Đã dịch?',
	'field-last-updated-at' => 'Lần cuối chỉnh sửa vào',

    // validation
    'name.required' => 'Tên gói còn trống',
    'name.max' => 'Tên gói không thể quá :max ký tự',
    'name.unique' => 'Tên gói bị trùng. Xin hãy dùng tên gói khác.',

    // message
    'not-found' => 'Gói từ ngữ không tồn tại.',
    'delete-warning' => 'Nếu bạn xóa gói từ ngữ này, hệ thống sẽ tự động xóa toàn bộ từ ngữ trong gói. Bạn có muốn tiếp tục?',
    'cache-is-turned-off' => 'Cấu hình Multilingual Cache đang bị tắt, hành động bị từ chối.',
];