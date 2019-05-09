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

function list_catagory_product() {
    $result = db_fetch_array("SELECT * FROM `catagory_product` ");
    foreach ($result as &$a) {
        $a['url_edit'] = "?mod=product&controller=cat_product&action=edit_catagory&id={$a['id']}";
        $a['url_delete'] = "?mod=product&controller=cat_product&action=delete_catagory&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
    $result = multi_data($result);
    return $result;
}

function get_list_page() {
    $result = db_fetch_array("SELECT * FROM `page_post` WHERE type ='page' ");
    foreach ($result as &$a) {
        $a['url_edit'] = "?mod=page&controller=index&action=edit&id={$a['id']}";
        $a['url_delete'] = "?mod=page&controller=index&action=delete&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
    return $result;
}

function get_list_menu() {
//    $sql = "SELECT product.*, catagory_product.catagory, media.link"
//                    . " FROM product LEFT JOIN catagory_product ON product.cat_product_id = catagory_product.id "
//                    . " LEFT JOIN media ON media.id=product.id_media  ORDER BY product.created_at DESC";
    $sql = "SELECT menu .*, type_menu.type_menu"
            . " FROM menu LEFT JOIN type_menu ON menu.id_type_menu = type_menu.id";
    $result = db_fetch_array($sql);
    foreach ($result as &$a) {
        $a['url_edit'] = "?mod=menu&controller=index&action=edit&id={$a['id']}";
        $a['url_delete'] = "?mod=menu&controller=index&action=delete&id={$a['id']}";
    }
    $result = multi_data($result);
    return $result;
}
function get_parent_id_menu($id){
    $result= db_num_row("SELECT * FROM menu WHERE parent_id = '{$id}' ");
    return $result;
  
}
function get_menu_by_id($id) {
    $sql = "SELECT * FROM menu WHERE id= '{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}

function get_type_menu() {
    $sql = "SELECT * FROM type_menu";
    $result = db_fetch_array($sql);
    foreach ($result as &$a) {
        $a['url_edit'] = "?mod=menu&controller=index&action=edit_type_menu&id={$a['id']}";
        $a['url_delete'] = "?mod=menu&controller=index&action=delete_type_menu&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
    return $result;
}

function get_type_menu_by_id($id) {
    $sql = "SELECT * FROM type_menu WHERE id = '{$id}'";
    $result = db_fetch_row($sql);
    $result['reg_at_fomat'] = date('H:i d-m-Y', $result['created_at']);
    return $result;
}

function insert_type_menu($data) {
    if (db_insert('type_menu', $data))
        return TRUE;
    return FALSE;
}

function get_list_type_menu() {
    $sql = "SELECT * FROM type_menu";
    $result = db_fetch_array($sql);
    foreach ($result as &$a) {
        $a['url_edit'] = "?mod=menu&controller=type_menu&action=edit_type_menu&id={$a['id']}";
        $a['url_delete'] = "?mod=menu&controller=type_menu&action=delete_type_menu&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
    return $result;
}

function get_list_type_menu_by_array_id($array_id){
    $sql = "SELECT * FROM type_menu WHERE id IN ($array_id) ";
    $result = db_fetch_array($sql);
    return $result;
}