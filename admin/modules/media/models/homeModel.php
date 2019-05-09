<?php

function get_list_media($search, $status) {
    if (empty($search)) {
        if (empty($status)) {
            $sql = "SELECT * FROM media  WHERE media.type != 'ảnh rác' ORDER BY media.created_at DESC";
        } else {
            $sql = "SELECT * FROM media  WHERE media.type= 'ảnh rác' ORDER BY media.created_at DESC";
        }
    } else {
        if (empty($status)) {
            $sql = "SELECT * FROM media where media.type LIKE '%{$search}%' ORDER BY media.created_at DESC";
        } else {
            $sql = "SELECT * FROM media where media.type LIKE '%{$search}%' AND media.type=''  ORDER BY media.created_at DESC";
        }
    }
    $result = db_fetch_array($sql);
    foreach ($result as &$a) {
        $a['url_delete'] = "?mod=media&controller=index&action=delete&id={$a['id']}";
        $a['reg_at_fomat'] = date('d-m-Y', $a['created_at']);
    }
    return $result;
}

function get_number_media() {
    $sql = "SELECT * FROM media";
    $result = db_num_row($sql);
    return $result;
}

function get_media($where) {
    $data = db_fetch_array("SELECT link FROM media WHERE {$where}");
    $result = array();
    foreach ($data as $k => $v) {
        $result[$k] = $v['link'];
    }
    return $result;
}

function get_num_media($field){
    if($field == 'bin'){
        $sql = "SELECT * FROM media WHERE type = 'ảnh rác'";
    }  else {
        $sql = "SELECT * FROM media WHERE type != 'ảnh rác'";
    }
    return db_num_row($sql);
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
