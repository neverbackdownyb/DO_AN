<?php
//Hàm gửi dữ thông báo
function flash_data($message) {
    $_SESSION['message'] = $message;
}

//Hàm lấy thông báo từ hàm flash_data
function get_flash_data() {
    $result = '';
    if (isset($_SESSION['message'])) {
        $result = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    return $result;
}

