<?php
defined('APPPATH') OR exit('Không được quyền truy cập phần này');

function construct(){
    load_model('product');
    load_model('catagory_product');
}

function detail_productAction(){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_product = get_product_by_id($id);
    
    //TÌm id cha ;
    $id_parent = get_parent_by_child($get_product['cat_product_id']);
    //Lấy id con dựa theo parent_id vừa tìm đc 
    $array_id = get_child_id_by_parent_id_product($id_parent);
    $id_child= implode(",", $array_id);
    //Lấy ra danh sách sẩn phẩm cùng danh mục ;
    $get_list_product_same_catagory  = get_list_product_by_array_id_product($id_child);
    //Lấy tên danh mục cha theo id sản phẩm.
    $get_title_parent = get_title_catagory_by_id_product($get_product['cat_product_id']);
    
    $data['list_product_same_catagory'] =$get_list_product_same_catagory;
    $data['title_parent'] =$get_title_parent;
    $data['product'] = $get_product;
    $data['title_page'] = "Chi tiết sản phẩm";

    load_view('detail_product',$data);
}




