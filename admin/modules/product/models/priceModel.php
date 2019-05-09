<?php

function add_price($data) {
    return db_insert('price', $data);
}

function total_product_by_price_id($id){
    $sql ="SELECT * FROM product WHERE price_range = '{$id}'";
    return db_num_row($sql);
}
function get_list_price() {
    $sql = "SELECT * FROM price";
    $result = db_fetch_array($sql);
    $stt = 0;
    foreach ($result as &$a) {
        $a['stt'] = ++$stt;
        $a['url_edit'] = "?mod=product&controller=price&action=edit_price&id={$a['id']}";
        $a['url_delete'] = "?mod=product&controller=price&action=delete_price&id={$a['id']}";
        $a['total_product'] = total_product_by_price_id($a['id']);
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
    return $result;
}

function get_price_by_id($id){
    $sql = "SELECT * FROM price WHERE id = '{$id}' ";
    $result = db_fetch_row($sql);
    return $result;
}

function get_price_by_array_id($array_id){
    $sql = "SELECT * FROM price WHERE id IN ($array_id)";
    $result = db_fetch_array($sql);
    return $result;
}
function update_price($price, $id){
    db_update('price', $price, "id = '{$id}'");
    return TRUE;
}