<?php

/*
 * Ham lấy ra sản phẩm theo mảng id;
 */

//
function get_list_product_by_array_id($array_id, $search, $price) {
    if (empty($search)) {
        if (empty($price)) {
            $sql = "SELECT product .*, media.link"
                    . " FROM product INNER JOIN media ON product.id_media = media.id"
                    . " WHERE product.cat_product_id IN ($array_id) ORDER BY rand() LIMIT 8";
        } else {
            $sql = "SELECT product .*, media.link"
                    . " FROM product INNER JOIN media ON product.id_media = media.id"
                    . " WHERE product.cat_product_id IN ($array_id) AND product.price_range='{$price}' ORDER BY rand() LIMIT 8";
        }
    } else {
        if (empty($price)) {
            $sql = "SELECT product .*, media.link"
                    . " FROM product INNER JOIN media ON product.id_media = media.id"
                    . " WHERE product.cat_product_id IN ($array_id) AND product.title LIKE '%{$search}%' ORDER BY rand() LIMIT 8";
        } else {
            $sql = "SELECT product .*, media.link"
                    . " FROM product INNER JOIN media ON product.id_media = media.id"
                    . " WHERE product.cat_product_id IN ($array_id) AND product.title LIKE '%{$search}%' AND product.price_range='{$price}' "
                    . "ORDER BY rand() LIMIT 8";
        }
    }
    $result = db_fetch_array($sql);
    foreach ($result as &$product) {
//        $title = get_title_catagory_product_by_id($id);
//        foreach ($title as $k => $v) {
//            $product['catagory'] = $v;
            $product['link'] = "admin/" . "{$product['link']}";
            $product['url_detail'] = "?mod=product&controller=product&action=detail_product&id=" . "{$product['id']}";
            $product['url_add_cart'] = "?mod=cart&controller=index&action=add&id=" . "{$product['id']}";
            $product['show_cart'] = "?mod=cart&controller=index&action=show_cart&id=" . "{$product['id']}";
            $product['price'] = currency_format($product['price']);
            $product['price_affter_sale'] = currency_format($product['price_affter_sale']);
//        }
    }
    return $result;
}

/*
 * Hàm lấy ra danh sách sản phẩm cùng loại theo id san phẩm 
 */
function  get_list_product_by_array_id_product($id_child){
    $sql = "SELECT product .*, media.link"
                    . " FROM product INNER JOIN media ON product.id_media = media.id"
                    . " WHERE product.cat_product_id IN ($id_child) ORDER BY rand() LIMIT 8";
    
     $result = db_fetch_array($sql);
    foreach ($result as &$product) {
            $product['link'] = "admin/" . "{$product['link']}";
            $product['detail_product'] = "?mod=product&controller=product&action=detail_product&id=" . "{$product['id']}";
            $product['add_cart'] = "?mod=cart&controller=index&action=add&id=" . "{$product['id']}";
            $product['show_cart'] = "?mod=cart&controller=index&action=show_cart&id=" . "{$product['id']}";
            $product['price'] = currency_format($product['price']);
            $product['price_affter_sale'] = currency_format($product['price_affter_sale']);
//        }
    }
    return $result;
}

/*
 * Hàm lấy trả về id con dựa theo id cha
 */

function get_child_id_by_parent_id_product($id) {
    $sql = "SELECT id FROM catagory_product WHERE parent_id = '{$id}'";
    $data = db_fetch_array($sql);
    foreach ($data as $item) {
        $result[] = $item['id'];
    }
    return $result;
}

/*
 * Hàm lấy ra tên danh mục cha theo id ;
 */

function get_title_catagory_product_by_id($id) {
    $sql = "SELECT catagory FROM catagory_product WHERE id = '{$id}'";
    return db_fetch_row($sql);
}

/*
 * Hàm lấy ra danh sách các khoảng giá
 */

function get_list_price() {
    $sql = "SELECT * FROM price";
    $result = db_fetch_array($sql);
    return $result;
}

/*
 * Lấy tên danh mục cha theo sản phẩm
 */

function get_title_catagory_by_id_product($id) {
    $sql = "SELECT * FROM catagory_product WHERE id = '{$id}'";
    $data= db_fetch_row($sql);
    $data['title'] = get_title_catagory_by_id_parent($data['parent_id']);
    $result['catagory'] = $data['title'];
    $result['title'] = $data['catagory'];
    return $result;
}

/* 
 * Lấy danh mục cha theo id 
 */

function get_title_catagory_by_id_parent($id) {
    $sql = "SELECT * FROM catagory_product WHERE id = '{$id}'";
    $data= db_fetch_row($sql);
    $result = $data['catagory'];
    return $result;
}