<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

function construct() {
    load_model('catagory_product');
    load_model('product');
}

function catagory_productAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $search = isset($_GET['search']) ? $_GET['search'] : "";
    $price = isset($_GET['price']) ? $_GET['price'] : "";


    //Lấy danh sách con theo id cha
    $child_id = get_child_id_by_parent_id_product($id);
    $array_id = implode(",", $child_id);
    //Lấy danh sách sảnh phẩm theo mảng id vừa tìm được
    $list_product = get_list_product_by_array_id($array_id, $search, $price);
    $catagory = get_catagory_product_by_id($id);
    $get_list_price = get_list_price();
//    show_array($_POST);
//    if(isset($_POST)){
//        show_array($_POST);
//    }
    $data['price'] = $price;
    $data['id'] = $id;
    $data['search'] = $search;
    $data['list_price'] = $get_list_price;
    $data['catagory'] = $catagory;
    $data['list_product'] = $list_product;
    $data['title_page'] = "Danh mục sản phẩm";

    load_view('catagory_product', $data);
}
