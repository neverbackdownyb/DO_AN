<?php

function get_list_slider($search, $status) {
    if (empty($status)) {
        if (empty($search)) {
            $sql = "SELECT slider.*, media.link "
                    . " FROM slider LEFT JOIN media ON slider.id_media = media.id";
        } else {
            $sql = "SELECT slider.*, media.link "
                    . " FROM slider LEFT JOIN media ON slider.id_media = media.id "
                    . "WHERE slider.capture LIKE '%{$search}%'  ORDER BY slider.created_at DESC";
        }
    } else {
        if (empty($search)) {
            $sql = "SELECT slider.*, media.link "
                    . " FROM slider LEFT JOIN media ON slider.id_media = media.id WHERE slider.status = '{$status}'";
        } else {
            $sql = "SELECT slider.*, media.link "
                    . " FROM slider LEFT JOIN media ON slider.id_media = media.id WHERE slider.status = '{$status}' AND "
                    . " slider.capture LIKE '%{$search}%'  ORDER BY slider.created_at DESC";
        }
    }
    $result = db_fetch_array($sql);
    foreach ($result as &$a) {
        $a['url_edit'] = "?mod=slide&controller=index&action=edit&id={$a['id']}";
        $a['url_delete'] = "?mod=slide&controller=index&action=delete&id={$a['id']}";
        $a['reg_at_fomat'] = date('d-m-Y', $a['created_at']);
    }
    return $result;
}

function get_num_slider($status) {
    if (!empty($status)) {
        $sql = "SELECT * FROM slider WHERE status = '{$status}'";
    } else {
        $sql = "SELECT * FROM slider";
    }
    $result = db_num_row($sql);
    return $result;
}

function get_number_media() {
    $sql = "SELECT * FROM media";
    $result = db_num_row($sql);
    return $result;
}

function get_media($where) {
    $data = db_fetch_array("SELECT link FROM media WHERE {$where} AND media.type='slider'");
    $result = array();
    foreach ($data as $k => $v) {
        $result[$k] = $v['link'];
    }
    return $data;
}

function get_media_by_id($id) {
    $where = "id IN ({$id})";
    $sql = "SELECT type FROM media WHERE {$where}";
    $data = db_fetch_array($sql);
    $result = array();
    foreach ($data as $k => $v) {
        $result[] = $v['type'];
    }
    return $result;
}

function get_slider_by_id($id) {
    $sql = "SELECT slider.*, media.link "
            . "FROM slider LEFT JOIN media ON slider.id_media = media.id "
            . "WHERE slider.id = '{$id}'";
    return $result = db_fetch_row($sql);
}

function get_slider_by_array_id($array_id){
    $sql = "SELECT slider.*, media.link"
            . " FROM slider INNER JOIN media ON slider.id_media = media.id "
            . "WHERE slider.id IN ({$array_id})";
    $data = db_fetch_array($sql);
    foreach($data as $v){
        $result[] = $v;
    }
    return $result;
}

function update_task_for_slider($option, $array_id) {
    $where = "id IN ({$array_id})";
    $data = array(
        'status' => $option,
    );
    if (db_update('slider', $data, $where))
        ;
    return TRue;
    return FALSE;
}
