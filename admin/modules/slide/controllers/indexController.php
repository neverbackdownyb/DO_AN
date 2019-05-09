<?php

function construct() {
    global $data;
    $admin = info_admin();
    $data['admin'] =$admin;
    load_model('home');
}

function addAction() {
    global $error, $title, $code, $excerpt, $status, $desc, $price, $id_media, $cat_id, $qty, $sale_of, $order_number;
    $data = array();
    if (isset($_POST['submit_add'])) {
        $admin = info_admin();
        $error = array();

        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên slide";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['excerpt'])) {
            $error['excerpt'] = "Không được để trống phần mô tả";
        } else {
            $excerpt = $_POST['excerpt'];
        }

        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Không được để trống phần hình ảnh ";
        } else {
            $id_media = $_POST['id_media'];
        }

        if (empty($_POST['order_number'])) {
            $error['order_number'] = "Không được để trống thứ tự";
        } else {
            $order_number = $_POST['order_number'];
        }

        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống trạng thái";
        } else {
            $status = $_POST['status'];
        }


        if (empty($error)) {
            $data = array(
                'capture' => $title,
                'excerpt' => $excerpt,
                'id_media' => $id_media,
                'order_number' => $order_number,
                'status' => $status,
                'created_by' => $admin['username'],
                'order_number' => $order_number,
                'created_at' => time(),
                'created_by' => $admin['username']
            );

            $id_slide = db_insert('slider', $data);
            $data_media = array(
                'id_connect' => $id_slide,
                'type' => 'slider');
            if ($id_slide) {
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Thêm mới",
                    'content' => $title,
                    'catagory' => 'Slider',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                db_update('media', $data_media, "id='{$id_media}'");
                flash_data("<p class='message_success'>Thêm mới slider thành công</p>");
                redirect("?mod=slide&controller=index&action=index");
            }
        }
    }
    $data['title_page'] = "Thêm mới slider";
    load_view('add', $data);
}

function editAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $slider = get_slider_by_id($id);
    $admin = info_admin();
    global $error, $title, $code, $excerpt, $status, $desc, $price, $id_media, $cat_id, $qty, $sale_of, $order_number;
    $data = array();
    if (isset($_POST['submit_add'])) {
        $admin = info_admin();
        $error = array();

        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên slide";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['excerpt'])) {
            $error['excerpt'] = "Không được để trống phần mô tả";
        } else {
            $excerpt = $_POST['excerpt'];
        }

        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Không được để trống phần hình ảnh ";
        } else {
            $id_media = $_POST['id_media'];
        }

        if (empty($_POST['order_number'])) {
            $error['order_number'] = "Không được để trống thứ tự";
        } else {
            $order_number = $_POST['order_number'];
        }

        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống trạng thái";
        } else {
            $status = $_POST['status'];
        }


        if (empty($error)) {
            $data = array(
                'capture' => $title,
                'excerpt' => $excerpt,
                'id_media' => $id_media,
                'order_number' => $order_number,
                'status' => $status,
                'created_by' => $admin['username'],
                'order_number' => $order_number,
                'created_at' => time(),
                'created_by' => $admin['username']
            );
            //khi không có lỗi cho update bảng slider vs giá trị vừa nhận
//            $where = "id = '{$id}'";
            if (db_update('slider', $data, "id = '{$id}'")) {
                if ($slider['id_media'] != $id_media) {
                    //Xóa bản ghi cũ trong media
                    db_delete('media', "id = '{$slider['id_media']}'");
                    // Đồng thời cập nhật dữ liệu mới. và xóa 
                    $data_media_new = array(
                        'type' => 'slider',
                        'id_connect' => $id,
                    );
                    db_update('media', $data_media_new, "id='{$id_media}'");
                    //Xóa ảnh cũ trong thư mục
                    if (file_exists($slider['link'])) {
                        unlink($slider['link']);
                    }
                }
                //THêm dữ liệu vào bảng lịch sử
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Cập nhật",
                    'content' => $title,
                    'catagory' => 'Slider',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Cập nhật slider thành công</p>");
                redirect("?mod=slide&controller=index&action=index");
            };
        }
    }
    $data['title_page'] = "Chỉnh sửa slider";
    $data['slider'] = get_slider_by_id($id);
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
    load('helper', 'option_status');
    $status = isset($_GET['status']) ? $_GET['status'] : "";
    $search = isset($_GET['search']) ? $_GET['search'] : "";

    $list_slider = get_list_slider($search, $status);
    $option = get_option_by_status_for_post($status);

    $data['option'] = $option;
    $data['num_slider'] = get_num_slider($status);
    $data['list_slider'] = $list_slider;
    $data['message'] = get_flash_data();
    $data['status'] = $status;
    $data['title_page'] = "Danh sách slider";
    load_view('index', $data);
}

function tasskAction() {
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
            flash_data("<p class='message_error'> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=slide&controller=index&action=index");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=slide&controller=index&action=index");
    }
}


function taskAction() {
    global $data;
//    show_array($data);exit;
//    $get_product_by_id = get_product_by_id($id);
//    show_array($get_product_by_id);exit;
    if (!empty($_POST['actions'])) {
        $option = $_POST['actions'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            $slider = get_slider_by_array_id($array_id);
//            show_array($slider);exit;
            if ($option == "destroy") {
                if (db_delete("slider", "id IN ({$array_id})")) {
                    //Thêm dữ liệu vào bảng history
                    foreach ($slider as $k => $v) {
                        $data_history = array(
                            'created_by' => $data['admin']['username'],
                            'action' => "Xóa",
                            'content' => $v['capture'],
                            'catagory' => 'Slider',
                            'created_at' => time(),
                        );
                        db_insert('history', $data_history);
                        //Xóa dữ liệu bản ghi trong bảng media
                        db_delete('media', "id ={$v['id_media']}");
                        //Xóa ảnh trong thư mục
                        if (file_exists($v['link'])) {
                            unlink($v['link']);
                        }
                    }
                    flash_data("<p class='message_success'>Xóa bài viết thành công ! </p>");
                    redirect("?mod=slide&controller=index&action=index");
                }
            }
            if (update_task_for_slider($option, $array_id)) {
                flash_data("<p class='message_success'> Cập nhật thông tin thành công ! </p>");
                redirect("?mod=slide&controller=index&action=index");
            } else {
                flash_data("<p class =message_error> Cập nhật không thành công! </p>");
                redirect("?mod=slide&controller=index&action=index");
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
