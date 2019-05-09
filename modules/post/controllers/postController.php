<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

function construct() {
    load_model('post');
}

function detail_postAction() {
    $id = (int) (isset($_GET['id'])) ? $_GET['id'] : '';
    $post = get_post_by_id($id);
    //Lấy tên danh mục cha theo id post.
    $get_title_parent = get_title_catagory_by_id_post($post['cat_post_id']);
//    echo $get_title_parent;
//   show_array($post);
    $data['post'] = $post;
    $data['title_page'] = "Chi tiết bài viết";
    load_view('detail_post', $data);
}
