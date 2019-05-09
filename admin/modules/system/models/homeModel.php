<?php

function get_num_system() {
    $sql = "SELECT * FROM system";
    $result = db_num_row($sql);
    return $result;
}

function get_system_by_id($id) {
    $sql = "SELECT system .*, media.link "
            . " FROM system LEFT JOIN media ON system.id_media = media.id"
            . " WHERE system.id = '{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}

function get_list_system() {
    $sql = "SELECT * FROM system";
    $result = db_fetch_array($sql);
    foreach ($result as &$a) {
        $a['url_edit'] = "?mod=system&controller=index&action=edit&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
    return $result;
}

?>