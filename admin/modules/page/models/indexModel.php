<?php

function get_list_student() {
    $result = db_fetch_array("SELECT * FROM `tbl_student`");
    return $result;
}

function insert_post($data) {
    $id = db_insert('page_post', $data);
    if ($id)
        return $id;
    return FALSE;
}

function get_list_page($status, $search) {
//    Nếu status trống 
//    $sql ="SELECT page_post.*, catagory_post.catagory, media.link"
//            . " FROM page_post INNER JOIN catagory_post ON page_post.cat_post_id = catagory_post.id "
//            . " INNER JOIN media ON media.id=page_post.id_media "
//            . "WHERE page_post.type='post'";
    if (empty($status)) {
        if (empty($search)) {
            $result = db_fetch_array("SELECT page_post.*, media.link"
                    . " FROM page_post LEFT JOIN media ON media.id=page_post.id_media "
                    . "WHERE page_post.type='page'");
        } else {
            $result = db_fetch_array("SELECT page_post.*, media.link"
                    . " FROM page_post LEFT JOIN media ON media.id=page_post.id_media "
                    . "WHERE page_post.type='page' AND page_post.title LIKE '%{$search}%'");
        }
    }
    //Tồn tại status
    else {
        if (empty($search)) {
            $result = db_fetch_array("SELECT page_post.*,  media.link"
                    . " FROM page_post LEFT JOIN media ON media.id=page_post.id_media "
                    . "WHERE page_post.type='page' AND page_post.status  = '{$status}'");
        } else {
            $result = db_fetch_array("SELECT page_post.*, media.link"
                    . " FROM page_post LEFT JOIN media ON media.id=page_post.id_media "
                    . "WHERE page_post.type='page' AND page_post.title LIKE '%{$search}%' AND page_post.status  = '{$status}'");
        }
    }

    foreach ($result as &$a) {

        $a['url_edit'] = "?mod=page&controller=index&action=edit&id={$a['id']}";
        $a['url_delete'] = "?mod=page&controller=index&action=delete&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
//    $result = multi_data($result);
    return $result;
}

function get_number_page($status) {
    if (empty($status)) {
        return db_num_row("SELECT * FROM `page_post` WHERE type='page'");
    } else {
        return db_num_row("SELECT * FROM `page_post` WHERE status = '{$status}' AND type='page'");
    }
}

 function get_page_by_array_id($array_id){
    $sql = "SELECT page_post.*, media.link"
            . " FROM page_post INNER JOIN media ON page_post.id_media = media.id "
            . "WHERE page_post.id IN ({$array_id})";
    $data = db_fetch_array($sql);
    foreach($data as $v){
        $result[] = $v;
    }
    return $result;
}

function update_task_for_post($option, $array_id) {
    $where = "id IN ({$array_id})";
    $data = array(
        'status' => $option,
    );
    if (db_update('page_post', $data, $where))
        ;
    return TRue;
    return FALSE;
}

function update_page_by_id($id, $data) {
    if (db_update("page_post", $data, "type='page' AND id='{$id}'"))
        return TRUE;
    return FALSE;
}

function get_page_by_id($id) {
    $sql = "SELECT page_post .*, media.link FROM page_post"
            . " LEFT JOIN media ON page_post.id_media = media.id "
            . "WHERE page_post.type='page' AND page_post.id='{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}
