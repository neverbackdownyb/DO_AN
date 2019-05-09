<?php

function construct() {
    global $data;
    $admin = info_admin();
    $data['admin'] = $admin;
    load_model('post');
    load_model('cat_post');
}

function addcatagoryAction() {
    global $error;
    $list_catagory = list_catagory_post();
    $data['list_catagory'] = $list_catagory;
    $admin = info_admin();
    if (isset($_POST['submit_add'])) {
        $error = array();
        $parent_cat = $_POST['parent_cat'];

        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên danh mục ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($error)) {
//Xử lý
            $data = array(
                'catagory' => $title,
                'parent_id' => $parent_cat,
                'created_at' => time(),
            );
            if (insert_catagory_post($data)) {
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Thêm danh mục",
                    'content' => $title,
                    'catagory' => 'bài viết',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Thêm mới danh mục thành công !<p>");
                redirect("?mod=post&controller=cat_post&action=catagory");
            }
        }
    }
    $data['title_page'] = "Thêm mới danh mục bài viết";
    load_view('addcatagory', $data);
}

function catagoryAction() {

    $data['message'] = get_flash_data();
    $data['list_catagory'] = list_catagory_post();
    $data['title_page'] = "Danh sách danh mục bài viết";
    load_view('catagory', $data);
}

function delete_catagoryAction() {
    global $data;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_catagory_post_by_id = get_catagory_post_by_id($id);
    $get_num_child_catagory_id = get_child_catagory_post_by_id($id);
    
    if ($get_num_child_catagory_id == 0) {
        if (db_delete("catagory_post", "id= {$id}")) {
            $data_history = array(
                'created_by' => $data['admin']['username'],
                'action' => "Xóa danh mục",
                'content' => $get_catagory_post_by_id['catagory'],
                'catagory' => 'bài viết',
                'created_at' => time(),
            );
            db_insert('history', $data_history);
        };
        flash_data("<p class='message_success'> Xóa danh mục thành công <p>");
        redirect("?mod=post&controller=cat_post&action=catagory");
    }  else {
        flash_data("<p class='message_error'> Bạn cần phải xóa hết danh mục con mới xóa được danh mục cha <p>");
        redirect("?mod=post&controller=cat_post&action=catagory");
    }
}

function edit_catagoryAction() {
    global $error, $title, $parent_cat;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $list_catagory = list_catagory_post();

    $data['list_catagory'] = $list_catagory;
    $catagory_post = get_catagory_post_by_id($id);
    $data['catagory_post'] = $catagory_post;
    $admin = info_admin();

    if (isset($_POST['submit_add'])) {
        $error = array();
        $parent_cat = $_POST['parent_cat'];

        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên danh mục ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($error)) {
//Xử lý
            $data = array(
                'catagory' => $title,
                'parent_id' => $parent_cat,
                'created_at' => time(),
            );
            if (update_catagory_by_id($id, $data)) {
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Sửa danh mục",
                    'content' => $catagory_post['catagory'],
                    'catagory' => 'bài viết',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class ='message_success'> Cập nhật thông tin thành công </p>");
                redirect("?mod=post&controller=cat_post&action=catagory");
            } else {
                flash_data("<p class ='message_errro'> Cập nhật thông tin không thành công </p>");
                redirect("?mod=post&controller=cat_post&action=catagory");
            }
        }
    }
    $data['title_page'] = "Chỉnh sửa danh mục bài viết";
    load_view('edit_catagory', $data);
}
