<?php
defined('APPPATH') OR exit('Không được quyền truy cập phần này');

function construct(){
    load_model('catagory_post');
}

function catagory_postAction(){
    $id = isset($_GET['id'])? $_GET['id'] : '';
    //Lấy ra danh sách id con theo id cha truyền vào;
    $list_array_child = get_child_id_by_parent_id_post($id);
    $array_id = implode(",", $list_array_child);
    //Lấy ra danh sách bài viết theo mảng id tìm được
    $list_post = get_list_product_same_catagory_post($array_id);
//    show_array($list_post);
    $data['title_catagory'] = get_title_catagory_post($id);
    $data['list_post'] =$list_post;
    $data['title_page'] = "Danh mục tin tức";
//    show_array($data);
    load_view('catagory_post',$data);
}


