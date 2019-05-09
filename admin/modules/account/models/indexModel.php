<?php

function add_admin($data) {
    if (db_insert('admin', $data))
        return TRUE;
    return FALSE;
}

//Lấy danh sách admin theo trạng thái
//4 trường hơp 1. status trống và $search trống => Lấy danh sách toàn bộ. nếu search tồn tại tìm theo search;
//             3. Status tồn tại và search trống => Tìm theo status. 4. tìm theo cả status và search.
function get_list_admin_by_status($status,$search) {
    
    if(empty($status)){
        if(empty($search)){
             $sql = "SELECT * FROM admin";
        }  else {
             $sql = "SELECT * FROM admin WHERE `admin`.`fullname` LIKE '%{$search}%'";
        }
    }  else {
        if(empty($search)){
             $sql = "SELECT * FROM admin WHERE status ='{$status}'";
        }  else {
             $sql = "SELECT * FROM admin WHERE status ='{$status}' AND `admin`.`fullname` LIKE '%{$search}%'";
        }
    }
    $result = db_fetch_array($sql);
    if (!empty($result)) {
        foreach ($result as &$val) {
            $val['url_delete'] = "?mod=account&controller=index&action=delete&id=" . $val['id'];
            $val['url_update'] = "?mod=account&controller=index&action=update&id=" . $val['id'];
            $val['time'] = get_date($val['created_at']);
        }
    }return $result;
}

function get_list_user_by_array_id($array_id){
    $sql = "SELECT admin.*, media.link"
            . " FROM admin LEFT JOIN media ON admin.id_media = media.id "
            . "WHERE admin.id IN ({$array_id})";
    $data = db_fetch_array($sql);
    foreach($data as $v){
        $result[] = $v;
    }
    return $result;
}

function update_admin_by_id($data, $id) {
    if (db_update('admin', $data, "id='{$id}'"))
        return TRUE;
        return FALSE;
}

function update_task_for_admin($option, $array_id) {
    $where = "id IN ({$array_id})";
    $data = array(
        'status' => $option,
    );
    if (db_update('admin', $data, $where))
        ;
    return TRue;
    return FALSE;
}

//SELECT page_post.*, catagory_post.catagory, media.link"
//                    . " FROM page_post LEFT JOIN catagory_post ON page_post.cat_post_id = catagory_post.id "
function get_info_admin_by_id($id) {
    $sql = "SELECT admin.* ,media.link FROM admin LEFT JOIN media ON admin.id_media = media.id WHERE admin.id='{$id}'";
//    return db_fetch_row("SELECT * FROM `admin` WHERE id ='{$id}'");
    return db_fetch_row($sql);
}

function delete_admin_by_id($id) {
    db_delete('admin', "id={$id}");
}

function check_password_admin($field) {
    $id = $_SESSION['account']['id'];
    $field = md5($field);
    $sql = "SELECT * FROM admin WHERE  id='{$id}' AND password='{$field}'";
    return db_num_row($sql);
}

function get_num_admin_by_status($status) {
    if (!empty($status)) {
        $sql = "SELECT * FROM admin WHERE status ='{$status}'";
    } else {
        $sql = "SELECT * FROM admin";
    }
    return db_num_row($sql);
}

function update_admin_multi_id($option, $array_id) {
    $where = "id IN ({$array_id})";
    if (empty($option)) {
        
    } elseif ($option == "destroy") {
        if (db_delete('admin', $where))
            flash_data("<p class='success'>Xóa thành công ! </p>");
            redirect("?mod=account&controller=index&action=index");
    } else {
        $data = array('status' => $option);
        if (db_update('admin', $data, $where))
            return TRUE;
        return FALSE;
    }
}

function list_role(){
    $sql = "SELECT role FROM admin";
    $result = db_fetch_array($sql);
    return $result;
}
?>