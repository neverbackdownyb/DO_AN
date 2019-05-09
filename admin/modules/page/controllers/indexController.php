<?php

function construct() {
    global $data;
    $admin = info_admin();
    $data['admin'] = $admin;
    load_model('index');
}

function addAction() {
    global $error, $title, $slug, $desc, $data;
    if (isset($_POST['submit_add'])) {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Tiêu đề không được để trống";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Slug không được để trống";
        } else {
            $slug = $_POST['slug'];
        }

        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được để trống mô tả";
        } else {
            $desc = $_POST['desc'];
        }

        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Không được để trống hình ảnh";
        } else {
            $id_media = $_POST['id_media'];
        }
        if (empty($error)) {
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'id_media' => $id_media,
                'type' => 'page',
                'description' => $desc,
                'status' => 'pendy',
                'created_at' => time(),
                'created_by' => $data['admin']['username'],
            );
//                        show_array($data);
            if (insert_post($data)) {
                flash_data("<p class='message_success'>Thêm mới bài viết thành công</p>");
                redirect("?mod=page&controller=index&action=index");
            }
        }
    }
    $data['title_page'] = "Thêm mới trang";
    load_view('add', $data);
}

function editAction() {
    global $error, $data;
//    show_array($data);
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $page = get_page_by_id($id);
    if (isset($_POST['submit_add'])) {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tiêu đề";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống phần này";
        } else {
            $slug = $_POST['slug'];
        }

        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được để trống mô tả";
        } else {
            $desc = $_POST['desc'];
        }

        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Không được để trống hình ảnh";
        } else {
            $id_media = $_POST['id_media'];
        }

        if (empty($error)) {
            $data_edit_page = array(
                'title' => $title,
                'slug' => $slug,
                'description' => $desc,
                'id_media' => $id_media,
            );
            if (update_page_by_id($id, $data_edit_page)) {
                if ($page['id_media'] != $id_media) {
                    //Xóa bản ghi cũ trong media
                    db_delete('media', "id = '{$page['id_media']}'");
                    // Đồng thời cập nhật dữ liệu mới. và xóa 
                    $data_media_new = array(
                        'type' => 'page',
                        'id_connect' => $id,
                    );
                    db_update('media', $data_media_new, "id='{$id_media}'");
                    //Xóa ảnh cũ trong thư mục
                    if (file_exists($page['link'])) {
                        unlink($page['link']);
                    }
                }
                //Cập nhật thành công thì thêm dữ liệu chỉnh sửa vào bảng history;
                $data_history = array(
                    'created_by' => $data['admin']['username'],
                    'action' => "Chỉnh sửa",
                    'content' => $page['title'],
                    'catagory' => 'page',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Cập nhật thành công </p>");
                redirect("?mod=page&controller=index&action=index");
            }
        }
    }

    $data['post'] = $page;
    $data['title_page'] = "Chỉnh sửa trang";
    load_view('edit', $data);
}

function deleteAction() {
    global $data;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $page = get_page_by_id($id);
//    show_array($page);exit;

    if (db_delete("page_post", "id= {$id}")) {
        //Thêm dữ liệu vào bảng history
        $data_history = array(
            'created_by' => $data['admin']['username'],
            'action' => "Xóa",
            'content' => $page['title'],
            'catagory' => 'page',
            'created_at' => time(),
        );
        db_insert('history', $data_history);
        //Xóa dữ liệu bản ghi trong bảng media
        db_delete('media', "id ={$page['id_media']}");
        //Xóa ảnh trong thư mục
        if (file_exists($page['link'])) {
            unlink($page['link']);
        }
        flash_data("<p class='message_success'> Xóa bài viết thành công <p>");
        redirect("?mod=page&controller=index&action=index");
    };
}

function indexAction() {
    load('helper', 'option_status');
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $data['status'] = $status;

    $option = get_option_by_status_for_post($status);
    $data['option'] = $option;

    $list_post = get_list_page($status, $search);
    $data['list_page'] = $list_post;

    $number_page = get_number_page($status);
    $data['number_page'] = $number_page;
    $data['message'] = get_flash_data();
    $data['title_page'] = "Danh sách trang";
    load_view('index', $data);
}

function taskAction() {
    global $data;
    if (!empty($_POST['actions'])) {
        $option = $_POST['actions'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            $list_page = get_page_by_array_id($array_id);
            if ($option == "destroy") {
                if (db_delete("page_post", "id IN ({$array_id})")) {
                    //Thêm dữ liệu vào bảng history
                    foreach ($list_page as $k => $v) {
                        $data_history = array(
                            'created_by' => $data['admin']['username'],
                            'action' => "Xóa",
                            'content' => $v['title'],
                            'catagory' => 'page',
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
                    redirect("?mod=page&controller=index&action=index");
                }
            }
            if (update_task_for_post($option, $array_id)) {
                flash_data("<p class='message_success'> Cập nhật thông tin thành công ! </p>");
                redirect("?mod=page&controller=index&action=index");
            } else {
                flash_data("<p class =message_error> Cập nhật không thành công! </p>");
                redirect("?mod=page&controller=index&action=index");
            }
        } else {
            flash_data("<p class='message_error'> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=page&controller=index&action=index");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=page&controller=index&action=index");
    }
}
