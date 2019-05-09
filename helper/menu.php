<?php

function show_tree($data, $parent = 0, $level = 0) {
    if (!is_array($data))
        return FALSE;
    foreach ($data as $a) {
        if ($a['parent_id'] == $parent) {
            $a['title'] = str_repeat('', $level) . $a['title'];
            $result[] = $a;
            if (check_has_child($data, $a['id'])) {
                $result_child = show_tree($data, $a['id'], $level + 1);
                $result = array_merge($result, $result_child);
            }
            unset($a);
        }
    }
    return $result;
}

function show_list_tree($data, $menu_id = '', $menu_class = '', $parent = 0, $level = 0) {
    if ($level == 0) {
        $list_html = "<ul class = '{$menu_class}' id='{$menu_id}'>";
    } else {
        $list_html = "<ul class='sub-menu'>";
    }
    foreach ($data as $a) {
        if ($a['parent_id'] == $parent) {
            $list_html.="<li>";
            $list_html.="<a href='{$a['url']}'>{$a['title']}</a>";
            if (check_has_child($data, $a['id'])) {
                $list_html .= show_list_tree($data, $menu_id, $menu_class, $a['id'], $level + 1);
            }
            unset($data[$a['id']]);
            $list_html.="</li>";
        }
    }
    $list_html .= "</ul>";
    return $list_html;
}

function check_has_child($data, $id = 0) {
    if (!is_array($data))
        return false;
    foreach ($data as $a) {
        if ($a['parent_id'] == $id)
            return true;
    }
    return FALSE;
}

function get_list_menu($value) {
        $sql = "SELECT menu .*"
                . "FROM menu INNER JOIN type_menu ON menu.id_type_menu = type_menu.id "
                . "WHERE type_menu.type_menu = '{$value}'";
 
    $result = db_fetch_array($sql);
    foreach ($result as &$item) {
        $url = "";
        if (isset($item['static_link'])) {
            $item['url'] = $item['static_link'];
        } elseif ($item['type_connect'] == "cat_product") {
            $item['url'] = "?mod=product&controller=catagory_product&action=catagory_product&id={$item['id_connect']}";
        } elseif ($item['type_connect'] == "page") {
            $item['url'] = "?mod=post&controller=detail_page&action=detail_page&id={$item['id_connect']}";
        } elseif ($item['type_connect'] == "cat_post") {
            $item['url'] = "?mod=post&controller=catagory_post&action=catagory_post&id={$item['id_connect']}";
        }
    }
    return $result;
}

?>