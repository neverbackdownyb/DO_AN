<?php

//domain.com?mod=home&controller=index&action=index

function construct() {
    load_model('post');
    load_model('cat_post');
}

function testAction() {
    load_view('test');
}

function addAction() {
    global $error, $title, $slug, $desc, $id_media, $cat_id, $excerpt;
    $list_catagory = list_catagory_post();
    $admin = info_admin();

    if (isset($_POST['submit_add'])) {
        $admin = info_admin();
        $error = array();
        $data = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên danh mục ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống slug";
        } else {
            $slug = $_POST['slug'];
        }

        if (empty($_POST['excerpt'])) {
            $error['excerpt'] = "Không được để trống phần mô tả";
        } else {
            $excerpt = $_POST['excerpt'];
        }

        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được để trống phần chi tiết bài viết";
        } else {
            $desc = $_POST['desc'];
        }

        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống phần slug";
        } else {
            $slug = $_POST['slug'];
        }

        if (empty($_POST['cat_id'])) {
            $error['cat_id'] = "Không được để trống phần danh mục";
        } else {
            $cat_id = $_POST['cat_id'];
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
                'description' => $desc,
                'excerpt' => $excerpt,
                'id_media' => $id_media,
                'created_at' => time(),
                'status' => 'pendy',
                'type' => 'post',
                'created_by' => $admin['username'],
                'cat_post_id' => $cat_id,
            );
            $id_post = insert_post($data);
            if ($id_post) {
                $data_media = array(
                    'id_connect' => $id_post,
                    'type' => 'post');
                db_update('media', $data_media, "id='{$id_media}'");
                //THêm vào lịch sử 
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Thêm mới",
                    'content' => $title,
                    'catagory' => 'bài viết',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);

                flash_data("<p class='message_success'>Thêm mới bài viết thành công</p>");
                redirect("?mod=post&controller=post&action=index");
            }
        }
    }
    $data['title_page'] = "Thêm mới bài viết";
    $data['list_catagory'] = $list_catagory;
    load_view('add', $data);
}

function delete_postAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_post_by_id = get_post_by_id($id);
    $id_media = $get_post_by_id['id_media'];
    $admin = info_admin();
    $id_delete = db_delete("page_post", "id= {$id}");
    if ($id_delete) {
        $data_history = array(
            'created_by' => $admin['username'],
            'action' => "Xóa",
            'content' => $get_post_by_id['title'],
            'catagory' => 'bài viết',
            'created_at' => time(),
        );
        db_insert('history', $data_history);
        //Cập nhật bảng media
        $data_media = array(
            'type' => NULL,
            'id_connect' => NULL,
        );
        db_update('media', $data_media, "id ={$id_media}");
    };
    flash_data("<p class='message_success'> Xóa bài viết thành công <p>");
    redirect("?mod=post&controller=post&action=index");
}

function edit_postAction() {
    global $error;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $post = get_post_by_id($id);
    $admin = info_admin();
//    show_array($post);exit;
    $list_catagory = list_catagory_post();
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

        if (empty($_POST['description'])) {
            $error['description'] = "Không được để trống chi tiết bài viết";
        } else {
            $description = $_POST['description'];
        }

        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Không được để trống hình ảnh";
        } else {
            $id_media = $_POST['id_media'];
        }

        if (empty($_POST['excerpt'])) {
            $error['excerpt'] = "Không được để trống mô tả";
        } else {
            $excerpt = $_POST['excerpt'];
        }

        if (empty($_POST['cat_post_id'])) {
            $error['cat_post_id'] = "Bạn chưa chọn danh mục";
        } else {
            $cat_post_id = $_POST['cat_post_id'];
        }

        if (empty($error)) {

            $data = array(
                'title' => $title,
                'slug' => $slug,
                'excerpt' => $excerpt,
                'description' => $description,
                'cat_post_id' => $cat_post_id,
                'id_media' => $id_media,
                'type' => 'post',
            );

            if (update_post_for_id($id, $data)) {
                $data_media_old = array(
                    'type' => NULL,
                    'id_connect' => NULL,
                );
                $data_media_new = array(
                    'type' => 'post',
                    'id_connect' => $id,
                );
                //Cập nhật bảng media . Cập nhật dữ liệu cũ là null . 
                // Đồng thời cập nhật dữ liệu mới. và xóa 
                db_update('media', $data_media_old, "id='{$post['id_media']}'");
                db_update('media', $data_media_new, "id='{$id_media}'");

                //Thêm vào bảng lịch sử
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Chỉnh sửa",
                    'content' => $post['title'],
                    'catagory' => 'bài viết',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'> Cập nhật thông tin bài viết thành công ! </p>");
                redirect("?mod=post&controller=post&action=index");
            }
        }
    }
    $data['title_page'] = "Chỉnh sửa bài viết";
    $data['list_catagory'] = $list_catagory;
    $data['post'] = $post;
    load_view('edit_post', $data);
}

function indexAction() {
    load('helper', 'option_status');
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $option = get_option_by_status_for_post($status);
    $data['option'] = $option;

    $list_post = get_list_post($status, $search);
    $data['list_post'] = $list_post;

    $number_post = get_number_post($status);

    $data['number_post'] = $number_post;
    $data['status'] = $status;
    $data['message'] = get_flash_data();
    $data['title_page'] = "Danh sách bài viết";
    load_view('index', $data);
}

function taskAction() {
    if (!empty($_POST['actions'])) {
        $option = $_POST['actions'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            if ($option == "destroy") {
                if (db_delete("page_post", "id IN ({$array_id})")) {
                    flash_data("<p class='message_success'>Xóa bài viết thành công ! </p>");
                    redirect("?mod=post&controller=post&action=index");
                }
            }
            if (update_task_for_post($option, $array_id)) {
                flash_data("<p class='message_success'> Cập nhật thông tin thành công ! </p>");
                redirect("?mod=post&controller=post&action=index");
            } else {
                flash_data("<p class => Cập nhật không thành công! </p>");
                redirect("?mod=post&controller=post&action=index");
            }
        } else {
            flash_data("<p class=''> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=post&controller=post&action=index");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=post&controller=post&action=index");
    }
}
