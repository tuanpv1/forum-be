<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 5/12/2017
 * Time: 7:11 AM
 */
namespace  common\helpers;

class Message
{
    const MSG_ADD_SUCCESS = 'Đã thêm mới thành công.';
    const MSG_ADD_ERROR =  'Thêm không thành công! Vui lòng thử lại';
    const MSG_ADD_ERROR_INACTIVE_TO = 'Không được chuyển từ trạng thái khác về chờ duyệt, Nếu user đã duyệt vui lòng cho vào banlist';
}