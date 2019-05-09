<?php

function list_catagory_post() {
    $result = db_fetch_array("SELECT * FROM `catagory_post` ");
    foreach ($result as &$a) {
        $a['url_edit'] = "?mod=post&controller=cat_post&action=edit_catagory&id={$a['id']}";
        $a['url_delete'] = "?mod=post&controller=cat_post&action=delete_catagory&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
    $result = multi_data($result);
    return $result;
}

function insert_catagory_post($data) {
    if (db_insert('catagory_post', $data))
        return TRUE;
    return FALSE;
}

function get_catagory_post_by_id($id) {
    return db_fetch_row("SELECT * FROM catagory_post WHERE id = '{$id}' ");
}

function get_child_catagory_post_by_id($id){
    $sql = "SELECT * FROM catagory_post WHERE parent_id = '{$id}'";
    return db_num_row($sql);
}

function update_catagory_by_id($id, $data) {
    if (db_update('catagory_post', $data, "id = {$id}"))
        return TRUE;
    return FALSE;
}