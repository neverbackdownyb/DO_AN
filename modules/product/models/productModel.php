<?php
/*
 * Hàm lấy thông tin danh mục theo id
 */
function get_catagory_product_by_id($id){
    return db_fetch_row("SELECT catagory FROM catagory_product WHERE id= '{$id}'");
}

/* 
 * Hàm lấy thông tin sản phầm theo id 
 */
function get_product_by_id($id){
    $sql = "SELECT product .*, media.link"
            . " FROM product INNER JOIN media ON product.id_media = media.id"
            . " WHERE product.id ='{$id}'";
    $result= db_fetch_row($sql);
    $result['link'] = "admin/".$result['link'];
    $result['add_cart']= "?mod=cart&controller=index&action=add&id=" ."$id";
    $result['price']= currency_format($result['price']);
    $result['price_affter_sale']= currency_format($result['price_affter_sale']);
    $result['show_cart']= "?mod=cart&controller=index&action=show_cart&id=" ."$id";
//    $result['catagory'] = get_catagory_product_by_id($result['cat_product_id']);
    return $result;
}
/*
 * Hàm lấy ra danh sách sản phẩm cùng danh mục
 */
function get_list_product_same_catagory($id){
      $sql = "SELECT product .*, media.link"
            . " FROM product INNER JOIN media ON product.id_media = media.id"
            . " WHERE product.cat_product_id ='{$id}'";
       $result = db_fetch_array($sql);
       foreach ($result as &$a){
           $a['link'] = "admin/".$a['link'];
           $a['detail_product'] = "?mod=product&controller=product&action=detail_product&id=".$a['id'];
           $a['show_cart'] = "?mod=cart&controller=index&action=show_cart&id=".$a['id'];
           $a['price'] = currency_format($a['price']);
           $a['price_affter_sale'] = currency_format($a['price_affter_sale']);
       }
       return $result;
      
}

/* 
 * Hàm lấy ra id cha theo id con 
 */
function get_parent_by_child($id){
    $sql = "SELECT parent_id FROM catagory_product WHERE id = '{$id}'";
    $result = db_fetch_row($sql);
    $id = $result['parent_id'];
    return $id;
}