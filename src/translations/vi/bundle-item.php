<?php
/**
 * Created by PhpStorm.
 * User: Seth Phat
 * Date: 12/13/2019
 * Time: 11:08 PM
 */

return [
    'title' => 'Quản lý từ ngữ',

    // fields
    'field-ID' => 'ID',
    'field-key' => 'Khóa',
    'field-text' => 'Từ ngữ',
    'field-description' => 'Mô tả',
    'field-translated' => 'Đã dịch?',
    'field-last-updated' => 'Lần cuối chỉnh sửa',
    'field-text-bundle' => 'Thuộc gói',
    'field-number-updates' => 'Số lần đã sửa',

    // message/note
    'field-select-a-bundle' => 'Chọn một gói từ ngữ',
    'delete-warning' => 'Nếu bạn xóa từ ngữ này, hệ thống sẽ xóa toàn bộ những từ ngữ đã dịch. Bạn có muốn tiếp tục?',
    'not-found' => 'Từ ngữ (ID: :id) không tồn tại.',

    // filter
    'filter-text-bundle' => 'Chỉ thuộc gói từ ngữ',
    'filter-lang-text-type' => 'Hiển thị từ ngữ ở ngôn ngữ',

    // some default text
    'all-bundle' => 'Tất cả gói',
    'current-language' => 'Ngôn ngữ hiện tại (Code: :lang)',

    // validation
    'key.required' => 'Khóa từ ngữ còn trống',
    'key.max' => 'Khóa từ ngữ tối đa chỉ được :max ký tự',
    'key.unique' => 'Đã có Khóa từ ngữ này trong gói từ ngữ của bạn, xin hãy nhập Khóa khác',

    'text_bundle_id.required' => 'Gói từ ngữ phải được chọn',
    'text_bundle_id.exists' => 'Gói từ ngữ bạn chọn không tồn tại, xin hãy thử lại',

];