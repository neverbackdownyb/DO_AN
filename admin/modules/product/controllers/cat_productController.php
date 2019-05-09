<?php

function construct() {
    global $data;
    $admin = info_admin();
    $data['admin'] = $admin;
    load_model('cat_product');
    load_model('product');
}

function add_catagoryAction() {
    global $error;
    $list_catagory = list_catagory_product();
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
            if (insert_catagory_product($data)) {
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Thêm mới ",
                    'content' => "Danh mục: $title",
                    'catagory' => 'sản phẩm',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Thêm mới danh mục thành công !<p>");
                redirect("?mod=product&controller=cat_product&action=list_catagory");
            }
        }
    }
    $data['title_page'] = "Thêm mới danh mục";
    load_view('add_catagory', $data);
}

function list_catagoryAction() {
    $list_catagory = list_catagory_product();
    $data['list_catagory'] = $list_catagory;
    $data['title_page'] = "Danh sách danh mục";
    load_view('list_catagory', $data);
}

function delete_catagoryAction() {
    global $data;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_catagory_product_by_id = get_catagory_product_by_id($id);
    $get_num_child_product = get_child_catagory_product_by_id($id);

    if ($get_num_child_product == 0) {
        if (db_delete("catagory_product", "id= {$id}")) {
            $data_history = array(
                'created_by' => $data['admin']['username'],
                'action' => "Xóa danh mục",
                'content' => $get_catagory_product_by_id['catagory'],
                'catagory' => 'sản phẩm',
                'created_at' => time(),
            );
            db_insert('history', $data_history);
        };
        flash_data("<p class='message_success'> Xóa danh mục thành công <p>");
        redirect("?mod=product&controller=cat_product&action=list_catagory");
    } else {
        flash_data("<p class='message_error'>Bạn cần xóa hết danh mục con trước khi xóa danh mục cha <p>");
        redirect("?mod=product&controller=cat_product&action=list_catagory");
    }
}

function edit_catagoryAction() {
    global $error, $title, $parent_cat;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $list_catagory_product = list_catagory_product();
    $catagory_product_by_id = get_catagory_product_by_id($id);
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
            if (update_catagory_product_by_id($id, $data)) {
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Sửa danh mục",
                    'content' => $catagory_product_by_id['catagory'],
                    'catagory' => 'sản phẩm',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class ='message_success'> Cập nhật thông tin thành công </p>");
                redirect("?mod=product&controller=cat_product&action=list_catagory");
            } else {
                flash_data("<p class ='message_error'>Cập nhật thông tin không thành công </p>");
                redirect("?mod=product&controller=cat_product&action=list_catagory");
            }
        }
    }
    $data['title_page'] = "Chỉnh sửa danh mục sản phẩm";
    $data['list_catagory_product'] = $list_catagory_product;
    $data['catagory_product_by_id'] = $catagory_product_by_id;
    load_view('edit_catagory', $data);
}
