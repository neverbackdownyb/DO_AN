<?php

function construct() {
    load_model('home');
}

function upload_singleAction() {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
//Bước 1: Tạo thư mục lưu file
        $error = array();
        $target_dir = "public/upload/";
        $target_file = $target_dir . rand(1, 99) . basename($_FILES['file']['name']);
        $result = "<p style='color:#4fa327'>Upload ảnh thành công </p>";

// Kiểm tra kiểu file hợp lệ
        $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error['file'] = "File bạn vừa chọn hệ thống không hỗ trợ, bạn vui lòng chọn hình ảnh";
        }
//Kiểm tra kích thước file
        $size_file = $_FILES['file']['size'];
        if ($size_file > 5242880) {
            $error['file'] = "File bạn chọn không được quá 5MB";
        }
// Kiểm tra file đã tồn tại trê hệ thống
        if (file_exists($target_file)) {
            $error['file'] = "File bạn chọn đã tồn tại trên hệ thống";
        }
//
        if (empty($error)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $flag = true;
                $data = array(
                    'link' => $target_file,
                    'type' => "ảnh rác",
                    'created_at' => time(),
                );
                $id_media = db_insert('media', $data);
                $data_media = array(
                    'status' => 'ok',
                    'file_path' => $target_file,
                    'result' => $result,
                    'id_media' => $id_media,
                );
                echo json_encode($data_media);
            } else {
                echo json_encode(array('status' => 'error', 'error' => $error['file']));
            }
        } else {
            echo json_encode(array('status' => 'error', 'error' => $error['file']));
        }
    }
}

function to_slugAction() {
    $str = $_POST['title'];
    echo to_slug($str);
}

function convert_moneyAction() {
    $sale_off = $_POST['sale_off'];
    $price = $_POST['price'];
    $price2 = $price - $price * $sale_off / 100;
    echo $price2;
}

function indexAction() {
    $status = isset($_GET['status']) ? $_GET['status'] : "";
    $search = isset($_GET['search']) ? $_GET['search'] : "";
    
    $list_media = get_list_media($search, $status);
    $data['html_pagging'] = $data['list_media'] = $list_media;
    $data['message'] = get_flash_data();
    $data['title_page'] = "Danh sách media";
    load_view('index', $data);
}

function taskAction() {
    if (!empty($_POST['actions'])) {
        $option = $_POST['actions'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            $where = "id IN ({$array_id})";
            $id = "$array_id";

            $get_media_by_id = get_media_by_id($id);
            $error = array();
            foreach ($get_media_by_id as $k) {
                if ($k != 'ảnh rác') {
                    $error['type'] = "Ảnh thuộc bài viết- Không thể xóa";
                    flash_data("<p class ='message_error'> Không thể xóa : Ảnh đang được sử dụng </p> ");
                    redirect("?mod=media&controller=index&action=index");
                } else {
                    if ($option == "delete") {
                        $media = get_media($where);
                        if (db_delete('media', $where)) {
                            foreach ($media as $k => $v) {
                                if (file_exists($v)) {
                                    unlink($v);
                                }
                            }
                            flash_data("<p class= 'message_success'> Xóa thành công </p>");
                            redirect("?mod=media&controller=index&action=index");
                        }
                    }
                }
            }
        } else {
            flash_data("<p class='message_error'> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=media&controller=index&action=index");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=media&controller=index&action=index");
    }
}

function deleteAction() {
    global $error;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_type_media_by_id = get_media_by_id($id);
//    show_array($get_type_media_by_id);exit;
    $where = "id IN ({$id})";
    $media = get_media($where);
    $error = array();
    foreach ($get_type_media_by_id as $k => $v) {
        if ($v != 'ảnh rác') {
            flash_data("<p class ='message_error'> Không thể xóa : Ảnh đang được sử dụng</p> ");
            redirect("?mod=media&controller=index&action=index");
        } else {
            if (db_delete('media', $where)) {
                foreach ($media as $k => $v) {
                    if (file_exists($v)) {
                        unlink($v);
                    }
                }
                flash_data("<p class= 'message_success'> Xóa thành công </p>");
                redirect("?mod=media&controller=index&action=index");
            }
        }
    }
}
