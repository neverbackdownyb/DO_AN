<?php

function construct() {
    global $data;
    load_model('product');
    load_model('cat_product');
    load_model('price');
    $admin = info_admin();
    $data['admin'] = $admin;
}

function edit_priceAction() {
    global $data;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_price_by_id = get_price_by_id($id);
    if (isset($_POST['sm_add'])) {
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên menu ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['order_num'])) {
            $error['order_num'] = "Không được để trống số thứ tự ";
        } else {
            $order_num = $_POST['order_num'];
        }

        if (empty($error)) {
            $price = array(
                'title' => $title,
                'order_num' => $order_num,
                'created_at' => time()
            );
//            show_array($data);
//            exit;
            if (update_price($price, $id)) {
                //Thêm mới vào lịch sử
                $data_history = array(
                    'created_by' => $data['admin']['username'],
                    'action' => "Cập nhật",
                    'content' => $get_price_by_id['title'],
                    'catagory' => 'khoảng giá',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Cập nhật khoảng giá thành công !<p>");
                redirect("?mod=product&controller=price&action=price");
            }
        }
    }
    $data['list_price'] = get_list_price();
//    show_array($data);
    $data['price'] = $get_price_by_id;
    $data['message'] = get_flash_data();
    $data['title_page'] = "Sửa khoảng giá";
    load_view('edit_price', $data);
}

function priceAction() {
    global $error, $data;
    $list_price = get_list_price();
    $error = array();
    if (isset($_POST['sm_add'])) {
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên menu ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['order_num'])) {
            $error['order_num'] = "Không được để trống số thứ tự ";
        } else {
            $order_num = $_POST['order_num'];
        }

        if (empty($error)) {
            $price = array(
                'title' => $title,
                'order_num' => $order_num,
                'created_at' => time()
            );

//            show_array($data);exit;
            $id_price = add_price($price);
            if ($id_price) {
                //Thêm mới vào lịch sử
                $data_history = array(
                    'created_by' => $data['admin']['username'],
                    'action' => "Thêm mới",
                    'content' => $title,
                    'catagory' => 'khoảng giá',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Thêm mới khoảng giá thành công !<p>");
                redirect("?mod=product&controller=price&action=price");
                exit;
            }
        }
    }
    $data['title_page'] = "Khoảng giá";
    $data['list_price'] = get_list_price();
    $data['message'] = get_flash_data();
    load_view('price', $data);
}

function delete_priceAction() {
    global $data;
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $get_price_by_id = get_price_by_id($id);
    $where = "id = '{$id}'";
    if (db_delete('price', $where)) {
        $data_history = array(
            'created_by' => $data['admin']['username'],
            'action' => "Xóa ",
            'content' => $get_price_by_id['title'],
            'catagory' => 'khoảng giá',
            'created_at' => time(),
        );
        db_insert('history', $data_history);
        flash_data("<p class='message_success'>Xóa khoảng giá thành công </p>");
        redirect("?mod=product&controller=price&action=price");
    }
}

function taskAction() {
    global $data;
    if (!empty($_POST['actions'])) {
        $option = $_POST['actions'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            $get_list_price = get_price_by_array_id($array_id);
            if ($option == "destroy") {
                if (db_delete("price", "id IN ({$array_id})")) {
                    //Thêm dữ liệu vào bảng history
                    foreach ($get_list_price as $k => $v) {
                        $data_history = array(
                            'created_by' => $data['admin']['username'],
                            'action' => "Xóa",
                            'content' => $v['title'],
                            'catagory' => 'Khoảng giá',
                            'created_at' => time(),
                        );
                        db_insert('history', $data_history);
                    }
                    flash_data("<p class='message_success'>Xóa khoảng giá thành công ! </p>");
                    redirect("?mod=product&controller=price&action=price");
                }
            }
        } else {
            flash_data("<p class='message_error'> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=product&controller=price&action=price");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=product&controller=price&action=price");
    }
}
