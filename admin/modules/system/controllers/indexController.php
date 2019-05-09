<?php

function construct() {
    global $data;
    load_model('home');
    $admin = info_admin();
    $data['admin'] = $admin;
}

function addAction() {
    global $data, $error, $title, $email, $address, $phone, $bank_name, $account_number, $fanpage, $google, $meta_description, $meta_key, $id_media;
    if (isset($_POST['submit_add'])) {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên website";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            $email = $_POST['email'];
        }

        if (empty($_POST['phone'])) {
            $error['phone'] = "Không được để trống số điện thoại";
        } else {
            $phone = $_POST['phone'];
        }

        if (empty($_POST['bank_name'])) {
            $error['bank_name'] = "Không được để trống tên ngân hàng";
        } else {
            $bank_name = $_POST['bank_name'];
        }

        if (empty($_POST['account_number'])) {
            $error['bank_name'] = "Không được để trống số tài khoản";
        } else {
            $account_number = $_POST['account_number'];
        }

        if (empty($_POST['fanpage'])) {
            $error['fanpage'] = "Không được để trống phần fanpage ";
        } else {
            $fanpage = $_POST['fanpage'];
        }

        if (empty($_POST['google'])) {
            $error['google'] = "Không được để trống phần google";
        } else {
            $google = $_POST['google'];
        }

        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống địa chỉ ";
        } else {
            $address = $_POST['address'];
        }

        if (empty($_POST['meta_key'])) {
            $error['meta_key'] = "Không được để trống meta_key ";
        } else {
            $meta_key = $_POST['meta_key'];
        }

        if (empty($_POST['meta_description'])) {
            $error['meta_description'] = "Không được để trống meta_description ";
        } else {
            $meta_description = $_POST['meta_description'];
        }

        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Không được để trống logo ";
        } else {
            $id_media = $_POST['id_media'];
        }


        if (empty($error)) {
            $data_system = array(
                'title' => $title,
                'email' => $email,
                'phone' => $phone,
                'bank_name' => $bank_name,
                'account_number' => $account_number,
                'fanpage' => $fanpage,
                'google' => $google,
                'address' => $address,
                'meta_key' => $meta_key,
                'meta_description' => $meta_description,
                'id_media' => $id_media,
                'created_at' => time(),
                'created_by' => $data['admin']['username']
            );
//                show_array($data_system);exit;
            $id_system = db_insert('system', $data_system);
            $data_media = array(
                'id_connect' => $id_system,
                'type' => 'system');
            if ($id_system) {
                $data_history = array(
                    'created_by' => $data['admin']['username'],
                    'action' => "Thêm mới",
                    'content' => $title,
                    'catagory' => 'system',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                db_update('media', $data_media, "id='{$id_media}'");
                flash_data("<p class='message_success'>Thêm mới system thành công</p>");
                redirect("?mod=system&controller=index&action=index");
            }
        }
    }
    $data['message'] = get_flash_data();
    $data['title_page'] = "Thêm mới thông tin hệ thống ";
    load_view('add', $data);
}

function editAction() {
    global $data, $error, $title, $email, $address, $phone, $bank_name, $account_number, $fanpage, $google, $meta_description, $meta_key, $id_media;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $system = get_system_by_id($id);
//    show_array($system);exit;
    if (isset($_POST['submit_add'])) {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên website";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            $email = $_POST['email'];
        }

        if (empty($_POST['phone'])) {
            $error['phone'] = "Không được để trống số điện thoại";
        } else {
            $phone = $_POST['phone'];
        }

        if (empty($_POST['bank_name'])) {
            $error['bank_name'] = "Không được để trống tên ngân hàng";
        } else {
            $bank_name = $_POST['bank_name'];
        }

        if (empty($_POST['account_number'])) {
            $error['bank_name'] = "Không được để trống số tài khoản";
        } else {
            $account_number = $_POST['account_number'];
        }

        if (empty($_POST['fanpage'])) {
            $error['fanpage'] = "Không được để trống phần fanpage ";
        } else {
            $fanpage = $_POST['fanpage'];
        }

        if (empty($_POST['google'])) {
            $error['google'] = "Không được để trống phần google";
        } else {
            $google = $_POST['google'];
        }

        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống địa chỉ ";
        } else {
            $address = $_POST['address'];
        }

        if (empty($_POST['meta_key'])) {
            $error['meta_key'] = "Không được để trống meta_key ";
        } else {
            $meta_key = $_POST['meta_key'];
        }

        if (empty($_POST['meta_description'])) {
            $error['meta_description'] = "Không được để trống meta_description ";
        } else {
            $meta_description = $_POST['meta_description'];
        }

        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Không được để trống logo ";
        } else {
            $id_media = $_POST['id_media'];
        }


        if (empty($error)) {
            $data_update_system = array(
                'title' => $title,
                'email' => $email,
                'phone' => $phone,
                'bank_name' => $bank_name,
                'account_number' => $account_number,
                'fanpage' => $fanpage,
                'google' => $google,
                'address' => $address,
                'meta_key' => $meta_key,
                'meta_description' => $meta_description,
                'id_media' => $id_media,
                'created_at' => time(),
                'created_by' => $data['admin']['username']
            );
//                show_array($data_update_system);exit;
            if (db_update('system', $data_update_system, "id = '{$id}'")) {
                if ($id_media != $system['id_media']) {
                    //Xóa bản ghi cũ trong media
                    db_delete('media', "id = '{$system['id_media']}'");
                    //Xóa ảnh cũ trong thư mục
                    if (file_exists($system['link'])) {
                        unlink($system['link']);
                    }
                    //Cập nhật ảnh mới 
                    $data_media_new = array(
                        'id_connect' => $id,
                        'type' => 'system');
                    db_update('media', $data_media_new, "id='{$id_media}'");
                }

                //Thêm dữ liệu bảng lịch sử 
                $data_history = array(
                    'created_by' => $data['admin']['username'],
                    'action' => "Chỉnh sửa",
                    'content' => $title,
                    'catagory' => 'system',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Chỉnh sửa thông tin hệ thống thành công</p>");
                redirect("?mod=system&controller=index&action=index");
            }
        }
    }
    $data['system'] = $system;
    $data['message'] = get_flash_data();
    $data['title_page'] = "Chỉnh sửa thông tin hệ thống ";
    load_view('edit', $data);
}

function deleteAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $slider = get_slider_by_id($id);
    $admin = info_admin();
//    show_array($slider);exit;
    //Xóa slider 
    if (db_delete('slider', "id= '{$id}'")) {
        //Xóa bản ghi trong media
        db_delete('media', "id = '{$slider['id_media']}'");
        //=> Thêm dữ liệu vào bảng history,
        $data_history = array(
            'created_by' => $admin['username'],
            'action' => "Xóa",
            'content' => $slider['capture'],
            'catagory' => 'Slider',
            'created_at' => time(),
        );
        db_insert('history', $data_history);
        //=> Xóa ảnh trong thư mục upload,
        if (file_exists($slider['link'])) {
            unlink($slider['link']);
        }
        flash_data("<p class= 'message_success'> Xóa slider thành công </p>");
        redirect("?mod=slide&controller=index&action=index");
    }
}

function indexAction() {
    $num_system = get_num_system();
    $data['message'] = get_flash_data();
    $list_system = get_list_system();
    $data['list_system'] = $list_system;
    $data['title_page'] = "Danh sách slider";
    if ($num_system) {
        load_view('index', $data);
    } else {
        load_view('add', $data);
    }
}

function taskAction() {
    $admin = info_admin();
    if (!empty($_POST['actions'])) {
        $option = $_POST['actions'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            $id = $array_id;
            $where = "id_connect IN ({$id})";
            $slider = get_title_by_array_id($array_id);
            $id = "id IN ({$array_id})";
            $get_media_by_id = get_media_by_id($id);
            $error = array();
            if (empty($error)) {
                if ($option == "destroy") {
                    $media = get_media($where);
                    //Khi xóa slider đồng thời xóa ảnh trong FODER upload và trả về null trong bảng media theo id
                    if (db_delete('slider', $id)) {
                        $data_media = array(
                            'type' => NULL,
                            'id_connect' => NULL
                        );
                        foreach ($media as $k => $v) {
                            if (file_exists($v['link'])) {
                                unlink($v['link']);
                            }
                        }
                        db_update('media', $data_media, $where);
                        foreach ($slider as $k => $v) {
                            $data_history = array(
                                'created_by' => $admin['username'],
                                'action' => "Xóa",
                                'content' => $v,
                                'catagory' => 'Slider',
                                'created_at' => time(),
                            );
                            db_insert('history', $data_history);
                        }
                        flash_data("<p class= 'message_success'> Xóa thành công </p>");
                        redirect("?mod=slide&controller=index&action=index");
                    }
                }
            }
        } else {
            flash_data("<p class=''> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=slide&controller=index&action=index");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=slide&controller=index&action=index");
    }
}
