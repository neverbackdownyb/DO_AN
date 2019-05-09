<?php

function add_post($data) {
    show_array($data);
    db_insert('catagory_post', $data);
}

function get_list_post($status, $search) {
//    Nếu status trống 
//    $sql ="SELECT page_post.*, catagory_post.catagory, media.link"
//            . " FROM page_post INNER JOIN catagory_post ON page_post.cat_post_id = catagory_post.id "
//            . " INNER JOIN media ON media.id=page_post.id_media "
//            . "WHERE page_post.type='post'";
    if (empty($status)) {
        if (empty($search)) {
            $result = db_fetch_array("SELECT page_post.*, catagory_post.catagory, media.link"
                    . " FROM page_post LEFT JOIN catagory_post ON page_post.cat_post_id = catagory_post.id "
                    . " LEFT JOIN media ON media.id=page_post.id_media "
                    . "WHERE page_post.type='post'");
        } else {
            $result = db_fetch_array("SELECT page_post.*, catagory_post.catagory, media.link"
                    . " FROM page_post LEFT JOIN catagory_post ON page_post.cat_post_id = catagory_post.id "
                    . " LEFT JOIN media ON media.id=page_post.id_media "
                    . "WHERE page_post.type='post' AND page_post.title LIKE '%{$search}%'");
        }
    }
    //Tồn tại status
    else {
        if (empty($search)) {
            $result = db_fetch_array("SELECT page_post.*, catagory_post.catagory, media.link"
                    . " FROM page_post LEFT JOIN catagory_post ON page_post.cat_post_id = catagory_post.id "
                    . " LEFT JOIN media ON media.id=page_post.id_media "
                    . "WHERE page_post.type='post' AND page_post.status  = '{$status}'");
        } else {
            $result = db_fetch_array("SELECT page_post.*, catagory_post.catagory, media.link"
                    . " FROM page_post LEFT JOIN catagory_post ON page_post.cat_post_id = catagory_post.id "
                    . " LEFT JOIN media ON media.id=page_post.id_media "
                    . "WHERE page_post.type='post' AND page_post.title LIKE '%{$search}%' AND page_post.status  = '{$status}'");
        }
    }

    foreach ($result as &$a) {

        $a['url_edit'] = "?mod=post&controller=post&action=edit_post&id={$a['id']}";
        $a['url_delete'] = "?mod=post&controller=post&action=delete_post&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
//    $result = multi_data($result);
    return $result;
}

function get_number_post($status) {
    if (empty($status)) {
        return db_num_row("SELECT * FROM `page_post` WHERE type='post'");
    } else {
        return db_num_row("SELECT * FROM `page_post` WHERE status = '{$status}' AND type='post'");
    }
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

function update_post_for_id($id, $data) {
    $id_update = (db_update('page_post', $data, "id= '{$id}'"));
    if ($id_update) {
        return $id_update;
        return FALSE;
    }
}

function insert_post($data) {
    $id = db_insert('page_post', $data);
    if ($id) {
        return $id;
        return FALSE;
    }
}

function get_post_by_id($id) {
    return db_fetch_row("SELECT page_post.*, catagory_post.catagory, media.link"
            . " FROM page_post LEFT JOIN catagory_post ON page_post.cat_post_id = catagory_post.id "
            . " LEFT JOIN media ON media.id=page_post.id_media "
            . "WHERE page_post.id= '{$id}'");
}
