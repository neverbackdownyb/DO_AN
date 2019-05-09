<?php

function get_list_history($search,$start,$number_per_page) {
    if (empty($search)) {
        $sql = "SELECT * FROM history ORDER BY history.created_at DESC LIMIT $start,$number_per_page ";
    } else {
        $sql = "SELECT * FROM history  WHERE history.catagory LIKE '{$search}'  ORDER BY history.created_at DESC ";
    }

    $result = db_fetch_array($sql);
    foreach ($result as &$a) {
        $a['delete'] = "?mod=history&controller=index&action=delete&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
    return $result;
}

function get_num_history() {
    $sql = "SELECT * FROM history ";
    $result = db_num_row($sql);
    return $result;
}

function get_total_history() {
    $result = db_fetch_row("SELECT COUNT(*) as 'total' FROM `history`");
    return $result['total'];
}

function create_pagging($num_page = 0,$base_url_pagging="",$current_page) {
    $pagging = "<ul class=\"pagging\">";
    for ($i = 1; $i <= $num_page; $i++) {
        $class_active="";
        if($current_page==$i){
            $class_active ="class='active'";
        }
        $pagging.=" <li {$class_active}><a href='{$base_url_pagging}&page={$i}'>{$i}</a></li>";
    }
    $pagging.="</ul>";
    return $pagging;
}
