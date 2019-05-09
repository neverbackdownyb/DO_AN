<?php

function construct() {
    global $data;
    load_model('home');
    load_model('show_home');
    load_model('cat_product', 'product');
    load_model('cat_post', 'post');

    $admin = info_admin();
    $data['admin'] = $admin;
}

function show_home_indexAction() {
    global $error, $data;
    $catagory_product = list_catagory_product();
    $catagory_post = list_catagory_post();

    if (isset($_POST['sm_add'])) {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên menu ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "Không được để trống số thứ tự ";
        } else {
            $menu_order = $_POST['menu_order'];
        }

        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống trạng thái";
        } else {
            $status = $_POST['status'];
        }

        if (empty($_POST['product_id'])) {
//            $error['product_id'] = "Không được để trống danh mục sản phẩm ";
        } else {
            $product_id = $_POST['product_id'];
        }

        if (empty($_POST['post_id'])) {
//            $error['post_id'] = "Không được để trống danh sách bài viết ";
        } else {
            $post_id = $_POST['post_id'];
        };

        if (isset($product_id)) {
            $type_connect = 'cat_product';
            $id_connect = $product_id;
        } else {
            if (!empty($post_id)) {
                $type_connect = "cat_post";
                $id_connect = $post_id;
            }
        }

        if (empty($error)) {
            $data_insert = array(
                'title' => $title,
                'id_connect' => $id_connect,
                'type_connect' => $type_connect,
                'status' => $status,
                'position' => $menu_order,
                'created_at' => time(),
                'created_by' => $data['admin']['username'],
            );
            if (db_insert('show_home', $data_insert)) {
                flash_data("<p class ='message_success' >Thêm thành công </p>");
                $data['message'] = get_flash_data();
                redirect("?mod=system&controller=show_home&action=show_home_index");
            }
        }
    }

    $data['title_page'] = "show menu";
    $data['list_show'] = get_list_show_home();
    $data['catagory_product'] = $catagory_product;
    $data['catagory_post'] = $catagory_post;
    $data['message'] = get_flash_data();
    load_view('show_home_index', $data);
}
