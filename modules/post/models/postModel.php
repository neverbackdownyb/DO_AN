<?php

function get_post_by_id($id) {
    $result = db_fetch_row("SELECT page_post.*, media.link"
            . " FROM page_post INNER JOIN media ON media.id=page_post.id_media "
            . "WHERE page_post.id= '{$id}' AND page_post.type ='post'");
    $result['created_at'] = date('H:i d-m-Y', $result['created_at']);
    return $result;
}


/*
 * Lấy tên danh mục cha theo sản phẩm
 */

function get_title_catagory_by_id_post($id) {
    $sql = "SELECT * FROM catagory_post WHERE id = '{$id}'";
    $data= db_fetch_row($sql);
    $data['title'] = get_title_catagory_by_id_parent($data['parent_id']);
    $result['catagory'] = $data['title'];
    $result['title'] = $data['catagory'];
    return $result;
}

/* 
 * Lấy danh mục cha theo id 
 */

function get_title_catagory_by_id_parent($id) {
    $sql = "SELECT * FROM catagory_post WHERE id = '{$id}'";
    $data= db_fetch_row($sql);
    $result = $data['catagory'];
    return $result;
}