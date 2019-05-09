<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

function construct() {
    load_model('index');
}

function type_menuAction() {
    global $error;
    $admin = info_admin();
    $list_menu = get_list_menu();
    if (isset($_POST['sm_add'])) {
        $error = array();

        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống loại menu ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['num_order'])) {
            $error['num_order'] = "Không được để trống thứ tự  ";
        } else {
            $num_order = $_POST['num_order'];
        }

        if (empty($error)) {
//Xử lý
            $data = array(
                'type_menu' => $title,
                'order_num' => $num_order,
                'created_at' => time(),
                'created_by' => $admin['username'],
            );
            if (insert_type_menu($data)) {
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Thêm loại ",
                    'content' => $title,
                    'catagory' => 'menu',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Thêm mới loại menu thành công !<p>");
                redirect("?mod=menu&controller=type_menu&action=type_menu");
            }
        }
    }
     $data['title_page'] = "Loại menu";
    $data['list_type_menu'] = get_list_type_menu();
    $data['message'] = get_flash_data();
    load_view('type_menu', $data);
}

function delete_type_menuAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $menu = get_type_menu_by_id($id);
    
    $admin = info_admin();
    if (db_delete('type_menu', "id = '{$id}'")) {
        $data_history = array(
            'created_by' => $admin['username'],
            'action' => "Xóa",
            'content' => $menu['type_menu'],
            'catagory' => 'menu',
            'created_at' => time(),
        );
        db_insert('history', $data_history);
        flash_data("<p class='message_success'> Xóa loại menu thành công <p> ");
        redirect("?mod=menu&controller=type_menu&action=type_menu");
    }
}

function edit_type_menuAction() {
    global $data;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_type_menu_by_id = get_type_menu_by_id($id);
//    show_array($get_type_menu_by_id);exit;
    if (isset($_POST['submit_add'])) {
        $error = array();

        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống loại menu ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['num_order'])) {
            $error['num_order'] = "Không được để trống thứ tự  ";
        } else {
            $num_order = $_POST['num_order'];
        }

        if (empty($error)) {
//Xử lý
            $data_update= array(
                'type_menu' => $title,
                'order_num' => $num_order,
                'created_at' => time(),
                'created_by' => $data['admin']['username'],
            );
            show_array($data_update);exit;
            if (db_update('type_menu', $data, "id ='{$id}'")) {
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Cập nhật ",
                    'content' => $title,
                    'catagory' => 'menu',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Cập nhật thông tin thành công  !<p>");
                redirect("?mod=menu&controller=index&action=type_menu");
            }
//               
        }
    }
     $data['title_page'] = "Chỉnh sửa loại menu";
    $data['message']= get_flash_data();
    $data['list_type_menu'] = get_list_type_menu();
    $data['type_menu'] = $get_type_menu_by_id;
    load_view('edit_type_menu', $data);
}

function taskAction() {
    $admin = info_admin();
    if (!empty($_POST['post_status'])) {
        $option = $_POST['post_status'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            $id = "id IN ({$array_id})";
            $menu = get_list_type_menu_by_array_id($array_id);
            if ($option == "destroy") {
                if (db_delete('type_menu', "id IN ({$array_id})")) {
                    foreach ($menu as $k => $v){
                        $data_history = array(
                        'created_by' => $admin['username'],
                        'action' => "Xóa ",
                        'content' => $v['type_menu'],
                        'catagory' => 'menu',
                        'created_at' => time(),
                    );
                    db_insert('history', $data_history);
                    }
                    
                    flash_data("<p class='message_success'>Xóa loại menu thành công ! </p>");
                    redirect("?mod=menu&controller=type_menu&action=type_menu");
                }
            }
        } else {
            flash_data("<p class='message_error'> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=menu&controller=type_menu&action=type_menu");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=menu&controller=type_menu&action=type_menu");
    }
}
