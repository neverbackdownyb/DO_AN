<?php

//Lấy danh sách các sản phẩm có khuyến mại ra
function list_product_discount() {
    $sql = "SELECT product.*, media.link FROM product INNER JOIN media ON media.id = product.id_media"
            . " WHERE disscount = 'yes' ORDER BY id DESC";
    $result = db_fetch_array($sql);
    foreach ($result as &$val) {
        $val['link'] = 'admin/' . $val['link'];
        $val['url_detail'] = '?mod=product&controller=product&action=detail_product&id=' . $val['id'];
        $val['show_cart'] = '?mod=cart&controller=index&action=show_cart&id=' . $val['id'];
        $val['price_affter_sale'] = currency_format($val['price_affter_sale']);
        $val['price'] = currency_format($val['price']);
    }
    return $result;
}

//Hàm lấy danh sách các hiển thị ra ở trang chủ.
function list_show_home() {
    $sql = "SELECT * FROM show_home ORDER BY position ASC ,id DESC";
    return db_fetch_array($sql);
}

//Hàm lấy danh sách các danh mục sản phẩm.
function list_cat_product() {
    $sql = "SELECT * FROM catagory_product";
    return db_fetch_array($sql);
}

/*
 * Hàm đếm số lượng sản phẩm theo từ khóa tìm kiếm
 */

function count_product_search($search = '') {
    $search = escape_string($search);
    $sql = "SELECT id FROM product WHERE title LIKE '%$search%'";
    return db_num_row($sql);
}


/*
 * Hàm lấy danh sách sản phẩm theo search
 */

function get_list_product_by_search($search = '', $start, $num_per_page) {
    $search = escape_string($search);
    $sql = "SELECT product.*, media.link FROM product "
            . " INNER JOIN media ON product.id_media = media.id "
            . " WHERE title LIKE '%$search%' ORDER BY id DESC LIMIT $start, $num_per_page";
    $result = db_fetch_array($sql);
    foreach ($result as $key => &$value) {
        $value['url'] = 'admin/' . $value['link'];
        $value['price'] = currency_format($value['price']);
        $value['price_affter_sale'] = currency_format($value['price_affter_sale']);
        $value['url_detail'] = '?mod=product&controller=product&action=detail_product&id=' . $value['id'];
        $value['url_add_cart'] = '?mod=cart&controller=index&action=add&id=' . $value['id'];
//        if ($value['is_discount'] == 'no') {
//            $value['origin_price'] = '';
//        } else {
//            $value['origin_price'] = currency_format($value['origin_price']);
//        }
//        $value['current_price'] = currency_format($value['current_price']);
    }
    return $result;
}
//Hàm lấy danh sách các danh mục bài viết
function list_cat_post() {
    $sql = "SELECT * FROM catagory_post";
    return db_fetch_array($sql);
}

//Hàm lấy danh sách các slide
function get_list_slider() {
    $sql = "SELECT slider.*, media.link FROM slider INNER JOIN media ON media.id = slider.id_media"
            . " WHERE slider.status = 'active' ORDER BY order_number ASC";
    $result = db_fetch_array($sql);
    foreach ($result as &$val) {
        $val['link'] = 'admin/' . $val['link'];
    }
    return $result;
}

//Hàm lấy danh sách các  sản phẩm theo id cha
function get_list_item_by_id_connect($type, $id) {
    if ($type == 'cat_product') {
        $data = list_cat_product();
//        echo $id; exit;
        $list_string_id_child = get_list_id_by_parent_id($data, $id, 'id', 'parent_id');
        $list_string_id_child[] = $id;
        $list_string_id_child = implode(',', $list_string_id_child);
        $sql = "SELECT product.*, media.link FROM product INNER JOIN media ON media.id = product.id_media"
                . " WHERE cat_product_id IN ($list_string_id_child) AND status='active' ";
    } else {
        $data = list_cat_post();
        $list_string_id_child = get_list_id_by_parent_id($data, $id, 'id', 'parent_id');
        $list_string_id_child = implode(',', $list_string_id_child);
        $sql = "SELECT page_post.*, media.link FROM page_post INNER JOIN media ON media.id = page_post.id_media"
                . " WHERE page_post.type = 'post' AND cat_post_id IN ($list_string_id_child) ";
    }
    $sql .= " LIMIT 0,8";
    $result = db_fetch_array($sql);
    //Kiểm tra nếu loại là cat_product thì gọi url đến modules khác, loại là cat_post thì gọi đến modules khác. Chỉ khác là id
    if ($type == 'cat_product') {
        $url = '?mod=product&controller=product&action=detail_product&id=';
    } else if ($type == 'cat_post') {
        $url = '?mod=post&controller=post&action=detail_post&id=';
    }
    foreach ($result as &$val) {
        $val['url_detail'] = $url . $val['id'];
        $val['show_cart'] = '?mod=cart&controller=index&action=show_cart&id=' . $val['id'];
        $val['link'] = 'admin/' . $val['link'];
          if (isset($val['price'])) {
        $val['price'] = currency_format($val['price']);
          }
        if (isset($val['disscount'])) {
            if ($val['disscount'] == 'yes') {
                $val['price_affter_sale'] = currency_format($val['price_affter_sale']);
            } else {
                $val['price_affter_sale'] = '';
            }
        }
    }
//    show_array($result);
    return $result;
}
// Hàm lấy id sản phẩm theo title 
function get_id_product_by_title($title){
    $sql = "SELECT id FROM catagory_product WHERE catagory = '{$title}'";
    $result = db_fetch_row($sql);
    return $result['id'];
}
?>


