<?php

function get_list_show_home() {
    $sql = "SELECT *FROM show_home";
    $result = db_fetch_array($sql);
    $stt = 0;
    foreach ($result as &$a) {
        $a['stt'] = ++$stt;
        $a['url_edit'] = "?mod=system&controller=show_home&action=edit_price&id={$a['id']}";
        $a['url_delete'] = "?mod=system&controller=show_home&action=delete_price&id={$a['id']}";
//        $a['total_product'] = total_product_by_price_id($a['id']);
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
    return $result;
}
