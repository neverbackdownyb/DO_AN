<?php

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


function get_catagory_product_by_id($id){
    return db_fetch_row("SELECT * FROM catagory_product WHERE id= '{$id}'");
}


function get_child_catagory_product_by_id($id){
    $sql = "SELECT * FROM catagory_product WHERE parent_id = '{$id}'";
    return db_num_row($sql);
}

function update_catagory_product_by_id($id, $data) {
    if (db_update('catagory_product', $data, "id = {$id}"))
        return TRUE;
    return FALSE;
}
