<?php
/**
 * Created by PhpStorm.
 * User: VS9 X64Bit
 * Date: 21/05/2015
 * Time: 11:25 AM
 */
namespace api\helpers;


class Message
{
    const MSG_SUCCESS = 'Thành công.';
    const MSG_FAIL = 'Không thành công. Vui lòng thử lại';
    const MSG_NOT_DATA = 'Không có dữ liệu';
    const MSG_ERROR_SYSTEM = 'Hệ thống hiện không thể thực hiện chức năng này, xin vui lòng quay lại sau';
    const MSG_LOGIN_FAIL_PASSWORD_NOT_CORRECT = 'Tên tài khoản hoặc mật khẩu chưa đúng. Vui lòng thử lại';
    const MSG_ADD_SUCCESS = 'Thêm mới thành công';
    const MSG_UPDATE_SUCCESS = 'Cập nhật thành công';
    const MSG_DELETE_SUCCESS = 'Xóa thành công';
    const MSG_LOGIN_SUCCESS = 'Quý khách đã đăng nhập thành công!';
    const MSG_NULL_VALUE = 'Trường {1} bắt buộc nhập!';
    const MSG_NOT_EMPTY = '{1} không được phép để trống';
    const MSG_NOT_FOUND_USER = 'Người dùng không tồn tại';
    const MSG_WRONG_USERNAME_OR_PASSWORD = 'Thông tin tài khoản hoặc mật khẩu không hợp lệ';
    const MSG_CHANGE_PASSWORD_SUCCESS = 'Đổi mật khẩu thành công';
    const MSG_OLD_PASSWORD_WRONG = 'Mật khẩu cũ không đúng, Quý khách vui lòng nhập lại';
    const MSG_UPDATE_PROFILE = 'Cập nhật thành công';
    const MSG_NUMBER_ONLY = '{1} phải là kiểu number.';
    const MSG_STRING_ONLY = '{1} phải là kiểu string.';
    const MSG_EXPIRED_SERVICE = 'Bạn chưa mua gói cước này hoặc gói cước đã hết hạn';
    const MSG_SERVICE_NOT_CONTENT = 'Tạm thời không thể truy cập nội dung này';
    const MSG_CANNOT_DELETE_ACTOR_DIRECTOR = '{1} đã được gán cho nội dung {2}. Không thể xóa';
    const MSG_CONFIRM = 'Bạn có chắc chắn?';
}