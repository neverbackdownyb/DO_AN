<?php

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
    exit;
}

/*
 * Hàm lấy danh sách các thông tin theo id
 */

function get_info_contact() {
    $sql = "SELECT * FROM system";
    $info = db_fetch_row($sql);
    $result = '<div class="block" id="about-us">
                <h3 class="title">Về chúng tôi</h3>
                <div class="detail">
                    <ul class="list-item">';
    $result .= '<li>
                   <a href="mailto:' . $info['email']  . '">' . $info['email'] . '</a>
                </li>
                <li>
                    <p class="phone">' . $info['phone'] . '</p>
                 </li>';
    $result .= '<a href="?mod=post&controller=detail_page&action=detail_page&id=8" title="" id="read-more">Xem thêm</a>';
    $result .= '</div>
            </div>';
    return $result;
}

/*
 *Hàm lấy ra thông tin sidebar_post 
 */
function get_side_bar_post(){
    $data = get_list_menu('Sidebar_post');
    show_array($data);
    foreach ($data as $item){
     $result = ' <div class="section" id="category-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục</h3>
                </div>';
     $result .=   ' <div class="section-detail">
                   <ul class="list-item">
                        <li>
                            <a href="" title="">'.$item['title'].'</a>
                        </li>
                    </ul>
                </div>
            </div>'   ;
    }
//    show_array($);
//    $info = show_list_tree($data,"sidebar","sidebar");
    
    return $result;
}


/*
 * Hàm lấy danh sách các menu con của menu cha.
 */

function get_child_menu($id, $data, $field_parent) {
    $result = array();
    foreach ($data as $key => $value) {
        if ($value[$field_parent] == $id) {
            $result[$key] = $value;
        }
    }
    return $result;
}
/*
 * Hàm lấy ra menu footer
 * @Trả về 1 chuỗi html footer
 */

function get_menu_footer() {
    $list_menu_footer = get_list_menu('footer');
    $list_menu_footer = show_tree($list_menu_footer);
//    show_array($list_menu_footer);
    $result = '';
    if (!empty($list_menu_footer)) {
        foreach ($list_menu_footer as $menu) {
            if ($menu['parent_id'] == 0) {
                $result .= '<div class = "block" id = "category-product">
                    <h3 class = "title">' . $menu['title'] . '</h3>
                    <div class = "detail">
                        <ul class = "list-item" >';
                //Lấy danh sách các menu con trong menu cha này ra
                $list_child_menu = get_child_menu($menu['id'], $list_menu_footer, 'parent_id');
//                show_array($list_child_menu);
                if (!empty($list_child_menu)) {
                    foreach ($list_child_menu as $child_menu) {
                        $result .= '<li>';
                        //Kiểm tra nếu nó là đường đường dẫn tĩnh thì in ra.
                        if ($child_menu['type_connect'] == '') {
                            $result .= "<a href='http://{$child_menu['url_static']}'>{$child_menu['title']}</a>";
                        } else if ($child_menu['type_connect'] == 'page') {
                            $result .= "<a href='?mod=post&controller=page&action=detail&id={$child_menu['id_connect']}'>{$child_menu['title']}</a>";
                        } else if ($child_menu['type_connect'] == 'cat_post') {
                            $result .= "<a href='?mod=post&controller=catagory_post&action=catagory_post&id={$child_menu['id_connect']}'>{$child_menu['title']}</a>";
                        } else if ($child_menu['type_connect'] == 'cat_product') {
                            $result .= "<a href='?mod=product&controller=catagory_product&action=catagory_product&id={$child_menu['id_connect']}'>{$child_menu['title']}</a>";
                        }

//                        $result .= '<a href="" title="">' . $menu['title'] . '</a>';
                        $result .= '</li>';
                    }
                }
                $result .= ' </ul>
                           </div>
                         </div>';
            }
        }
    }
    return $result;
}


/*
 * Hàm lấy ra tiêu đề trang web
 * Nếu có tiêu đề thì in ra , Không có thì để dothanhha.com
 */
function get_title_page(){
    global $data;
    if(isset($data['title_page'])){
        echo $data['title_page'];
    }  else {
        echo "dothanhha.com";
    }
}
//end get_menu footer
/*
 * Hàm lấy danh sách các id là con, cháu, ...
 * Hàm trả về 1 mảng chứa các id con cháu.
 */

function get_list_id_by_parent_id($data, $id, $field_key, $field_parent_id) {
    $result = array();
    foreach ($data as $key => $item) {
        if ($item[$field_parent_id] == $id) {
            $result[] = $item[$field_key];
            unset($data[$key]);
            $child = get_list_id_by_parent_id($data, $item[$field_key], $field_key, $field_parent_id);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}

/*
 * Hàm lấy ra danh sách sản phẩm mới nhất
 */

function get_list_product_new() {
    $sql = "SELECT product .*, media.link"
            . " FROM product INNER JOIN media ON product.id_media = media.id"
            . " ORDER BY product.created_at ASC LIMIT 6 ";
    $result = db_fetch_array($sql);
    foreach ($result as $k => &$item) {
        $item['detail_product'] = "?mod=product&controller=product&action=detail_product&id=" . "{$item['id']}";
        $item['price'] = currency_format($item['price']);
        $item['link'] = "admin/" . $item['link'];
    }
    return $result;
}

function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function multi_data($data, $parent_id = 0, $level = 0) {
    $result = array();
    foreach ($data as $item_data) {
        if ($item_data['parent_id'] == $parent_id) {
            $item_data['level'] = $level;
            $result[] = $item_data;
            $result_child = multi_data($data, $item_data['id'], $level + 1);
            $result = array_merge($result, $result_child);
        }
    }
    return $result;
}

function get_menu_header() {
    $list_menu = get_list_menu('header');
    $list_tree = show_list_tree($list_menu, "main-menu", "float_left");
    return $list_tree;
}
