<?php
//@ Hàm kiểm tra xem tên đăng nhập và mật khẩu có đúng trong csdl không
//@ Tham số: $username, $password
//$ Trả về user_id nếu đúng tên đăng nhập và mật khẩu trong csdl, false nếu không đúng
function check_user($username, $password) {
    global $conn;
    $password = md5($password);
    $sql = "SELECT id FROM admin WHERE username ='{$username}' AND password = '{$password}' ";
//    echo $sql; exit;
    return db_num_row($sql);
}

function check_login($username){
    $sql = "SELECT id FROM admin WHERE username='{$username}' AND status= 'active'";
    $user = db_fetch_row($sql);
    return $user['id'];
}

function is_login(){
    if(isset($_SESSION['account']) && $_SESSION['account']['is_login']=="TRUE"){
        return TRUE;
        return FALSE;
    }
}
function info_admin(){
    $result = '';
if(isset($_SESSION['account'])){
//   ($_SESSION[account]['id'])
//   /    $id=  isset($_GET['id'])?$_GET['id']:'';
        $id_admin = isset($_SESSION['account']['id']) ? $_SESSION['account']['id']:'';
         $sql = "SELECT admin.* ,media.link FROM admin LEFT JOIN media ON admin.id_media = media.id WHERE admin.id='{$id_admin}'";
//        $sql = "SELECT * FROM admin WHERE id = '{$id_admin}'";
        $result = db_fetch_row($sql);
    }
    return $result;
}

