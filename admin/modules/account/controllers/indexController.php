<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

function construct() {
    global $data;
    $admin = info_admin();
    $data['admin'] = $admin;
    load_model('index');
}

function indexAction() {
    //load file trực tiếp;
    load('helper', 'option_status');
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $search = isset($_POST['s']) ? $_POST['s'] : '';
    $option = get_option_by_status($status);
    $data['option'] = $option;
    $list_admin = get_list_admin_by_status($status, $search);
    $data['list_admin'] = $list_admin;

    $num_admin = get_num_admin_by_status($status);

    $data['message'] = get_flash_data();
    $data['num_admin'] = $num_admin;
    $data['title_page'] = "Danh sách tài khoản";
    load_view('index', $data);
}

function taskAction() {
    global $data, $error;
//    $get_product_by_id = get_product_by_id($id);
//    show_array($get_product_by_id);exit;
    if (!empty($_POST['actions'])) {
        $option = $_POST['actions'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            $get_user_by_array_id = get_list_user_by_array_id($array_id);
            if ($option == "destroy") {
                if (db_delete("admin", "id IN ({$array_id})")) {
                    //Thêm dữ liệu vào bảng history
                    foreach ($get_user_by_array_id as $k => $v) {
                        $data_history = array(
                            'created_by' => $data['admin']['username'],
                            'action' => "Xóa",
                            'content' => $v['username'],
                            'catagory' => 'tài khoản',
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
                    redirect("?mod=account&controller=index&action=index");
                }
            }
            if (update_task_for_admin($option, $array_id)) {
                flash_data("<p class='message_success'> Cập nhật thông tin thành công ! </p>");
                redirect("?mod=account&controller=index&action=index");
            } else {
                flash_data("<p class =message_error> Cập nhật không thành công! </p>");
                redirect("?mod=account&controller=index&action=index");
            }
        } else {
            flash_data("<p class=''> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=account&controller=index&action=index");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=account&controller=index&action=index");
    }
}

function updateAction() {
    global $error, $fullname, $username, $tel, $address, $email,$data;
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $user = get_info_admin_by_id($id);
    $list_role = list_role();

    if (isset($_POST['submit_update'])) {
        $error = array();
        //Kiểm tra tên đăng nhập
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Bạn chưa nhập vào tên đăng nhập";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Bạn chưa nhập vào email";
        } else {
            $email = $_POST['email'];
        }
        //Kiểm tra tel
        if (empty($_POST['tel'])) {
            $error['tel'] = "Bạn chưa nhập vào số điện thoại";
        } else {
            $tel = $_POST['tel'];
        }
        //Kiểm tra địa chỉ
        if (empty($_POST['address'])) {
            $error['address'] = "Bạn chưa nhập vào địa chỉ";
        } else {
            $address = $_POST['address'];
        }
        //Kiểm tra chức vụ
        if (empty($_POST['role'])) {
            $error['role'] = "Bạn chưa chọn quyền";
        } else {
            $role = $_POST['role'];
        }
        //Kiểm tra hình ảnh
        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Bạn chưa nhập vào hình ảnh";
        } else {
            $id_media = $_POST['id_media'];
        }
        //Kiểm tra , update
        if (empty($error)) {
            $data_update= array(
                'fullname' => $fullname,
                'email' => $email,
                'id_media' => $id_media,
                'phone' => $tel,
                'address' => $address,
                'role' => $role,
            );
            $id_update_admin = update_admin_by_id($data_update, $id);
            if ($id_update_admin) {
               if ($user['id_media'] != $id_media) {
                    //Xóa bản ghi cũ trong media
                    db_delete('media', "id = '{$user['id_media']}'");
                    // Đồng thời cập nhật dữ liệu mới. và xóa 
                    $data_media_new = array(
                        'type' => 'account',
                        'id_connect' => $id,
                    );
                    db_update('media', $data_media_new, "id='{$id_media}'");
                    //Xóa ảnh cũ trong thư mục
                    if (file_exists($user['link'])) {
                        unlink($user['link']);
                    }
                }
                //Cập nhật thành công thì thêm dữ liệu chỉnh sửa vào bảng history;
                $data_history = array(
                    'created_by' => $data['admin']['username'],
                    'action' => "Chỉnh sửa",
                    'content' => $user['username'],
                    'catagory' => 'account',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Cập nhật thành công </p>");
                redirect("?mod=account&controller=index&action=index");
            }
        }
    }
    $data_view['title_page'] = "Cập nhật tài khoản";
    $data_view['list_role'] = $list_role;
    $data_view['user'] = $user;
    load_view('update', $data_view);
}

function deleteAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    delete_admin_by_id($id);
    flash_data("<p class='message_success'>Xóa thành viên thành công </p>");
    redirect("?mod=account&controller=index&action=index");
}

function info_adminAction() {
    global $error, $fullname, $username, $tel, $address, $email,$data;
    $id = $_SESSION['account']['id'];
    $user = get_info_admin_by_id($id);
    $data['user'] = $user;
    if (isset($_POST['submit_update'])) {
        $error = array();
        //Kiểm tra tên đăng nhập
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Bạn chưa nhập vào tên đăng nhập";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Bạn chưa nhập vào email";
        } else {
            $email = $_POST['email'];
        }
        //Kiểm tra tel
        if (empty($_POST['tel'])) {
            $error['tel'] = "Bạn chưa nhập vào số điện thoại";
        } else {
            $tel = $_POST['tel'];
        }
        //Kiểm tra địa chỉ
        if (empty($_POST['address'])) {
            $error['address'] = "Bạn chưa nhập vào địa chỉ";
        } else {
            $address = $_POST['address'];
        }

        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Bạn chưa nhập vào hình ảnh";
        } else {
            $id_media = $_POST['id_media'];
        }
        //Kiểm tra , update
        if (empty($error)) {
            $data_update = array(
                'fullname' => $fullname,
                'email' => $email,
                'id_media' => $id_media,
                'phone' => $tel,
                'address' => $address,
            );
            $id_update_admin = update_admin_by_id($data_update, $id);
            if ($id_update_admin) {
                if ($user['id_media'] != $id_media) {
                    //Xóa bản ghi cũ trong media
                    db_delete('media', "id = '{$user['id_media']}'");
                    // Đồng thời cập nhật dữ liệu mới. và xóa 
                    $data_media_new = array(
                        'type' => 'account',
                        'id_connect' => $id,
                    );
                    db_update('media', $data_media_new, "id='{$id_media}'");
                    //Xóa ảnh cũ trong thư mục
                    if (file_exists($user['link'])) {
                        unlink($user['link']);
                    }
                }
                //Cập nhật thành công thì thêm dữ liệu chỉnh sửa vào bảng history;
                $data_history = array(
                    'created_by' => $data['admin']['username'],
                    'action' => "Chỉnh sửa",
                    'content' => $user['username'],
                    'catagory' => 'account',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Cập nhật thành công </p>");
                redirect("?mod=account&controller=index&action=index");
            }
        }
    }
    $data['title_page'] = "Thông tin tài khoản";
    load_view('info_admin', $data);
}

function addAction() {
    global $error, $fullname, $username, $tel, $address, $email, $status, $search;

    $list_admin = get_list_admin_by_status($status, $search);
    $admin = info_admin();
    $data = array();
    if (isset($_POST['submit_add'])) {
        $error = array();
        //Kiểm tra tên đăng nhập
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Bạn chưa nhập vào tên đăng nhập";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra tên username
        if (empty($_POST['username'])) {
            $error['username'] = "Bạn chưa nhập vào username";
        } else {
            $username = $_POST['username'];
        }
        //Kiểm tra tên email
        if (empty($_POST['email'])) {
            $error['email'] = "Bạn chưa nhập vào email";
        } else {
            $email = $_POST['email'];
        }
        //Kiểm tra tên password
        if (empty($_POST['password'])) {
            $error['password'] = "Bạn chưa nhập vào password";
        }
        //Kiểm tra tên re_password
        if (empty($_POST['repassword'])) {
            $error['repassword'] = "Bạn chưa nhập vào password";
        } elseif ($_POST['password'] == $_POST['repassword']) {
            $password = $_POST['password'];
        } else {
            $error['repassword'] = "Mật khẩu vừa nhập không trùng nhau";
        }

        //Kiểm tra tên tel
        if (empty($_POST['tel'])) {
            $error['tel'] = "Bạn chưa nhập vào tel";
        } else {
            $tel = $_POST['tel'];
        }
        //Kiểm tra tên tel
        if (empty($_POST['address'])) {
            $error['address'] = "Bạn chưa nhập vào address";
        } else {
            $address = $_POST['address'];
        }
        //Kiểm tra tên quyền
        if (empty($_POST['role'])) {
            $error['role'] = "Bạn chưa nhập vào quyền";
        } else {
            $role = $_POST['role'];
        }
        //kiểm tra ảnh đại diện 
        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Không được để trống hình ảnh";
        } else {
            $id_media = $_POST['id_media'];
        }

        foreach ($list_admin as $item) {
            if ($item['username'] == $username) {
                $error['ex_username'] = "username đã tồn tại trên hệ thống";
            } elseif ($item['email'] == $email) {
                $error['ex_email'] = "Mỗi email chỉ được đăng ký 1 tài khoản ";
            } elseif ($item['phone'] == $tel) {
                $error['ex_phone'] = "Mỗi số điện thoai chỉ được đăng ký 1 tài khoản ";
            }
        }
        //KIểm tra điều kiện
        if (empty($error)) {
            $code_update = md5('fullname');
            $code_active = md5('fullname');
            $data = array(
                'fullname' => $fullname,
                'username' => $username,
                'password' => md5($password),
                'email' => $email,
                'address' => $address,
                'id_media' => $id_media,
                'phone' => $tel,
                'created_at' => time(),
                'created_by' => $admin['username'],
                'code_active' => md5("admin" . $username),
                'code_update' => $code_update,
                'status' => 'pendy',
                'role' => $role,
            );

            $id_add_admin = add_admin($data);

            if ($id_add_admin) {
                $data_media = array(
                    'id_connect' => $id_add_admin,
                    'type' => 'account');
                db_update('media', $data_media, "id='{$id_media}'");
                //THêm vào lịch sử 
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Thêm mới ",
                    'content' => $username,
                    'catagory' => 'Tài khoản',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'>Thêm thành viên thành công </p>");
                redirect("?mod=account&controller=index&action=index");
            } else {
                $data['error'] = $error;
            }
        }
    }
    $data['title_page'] = "Thêm mới tài khoản";
    load_view('add', $data);
}

function change_passwordAction() {
    global $error;
    $id = $_SESSION['account']['id'];
    $admin = get_info_admin_by_id($id);

    if (isset($_POST['submit_change_password'])) {
        $error = array();

        if (empty($_POST['old_password'])) {
            $error['old_password'] = "Bạn chưa điền vào mật khẩu cũ  ";
        } elseif (!check_password_admin($_POST['old_password'])) {
            $error['password'] = "Mật khẩu vừa nhâp không đúng";
        } else if ($_POST['old_password'] == $_POST['new_password']) {
            $error['password'] = "Mật khẩu bạn muốn đổi trùng với mật khẩu cũ";
        }

        if (empty($_POST['new_password'])) {
            $error['new_password'] = "Bạn chưa điền vào mật khẩu mới  ";
        }

        if (empty($_POST['re_password'])) {
            $error['re_password'] = "Bạn chưa nhập lại mật khẩu  ";
        } elseif ($_POST['re_password'] != $_POST['new_password']) {
            $error['check_pass'] = "Mât khẩu vừa nhập không khớp";
        }

        if (empty($error)) {
            $password = md5($_POST['new_password']);
            $data = array(
                'password' => $password,
            );
            if (update_admin_by_id($data, $id)) {
                flash_data("<p class='message_success'>Cập nhật mật khẩu thành công </p>");
                redirect("?mod=account&controller=index&action=index");
            }
        }
    }
    $data['title_page'] = "Đổi mật khẩu";
    load_view('change_password', $data);
}

function loginAction() {
    global $error;
    if (isset($_POST['sm_login'])) {
        $error = array();
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập ";
        } else {
            $username = $_POST['username'];
        }
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            $password = $_POST['password'];
        }
        if (empty($error)) {
            if (check_user($username, $password)) {
                $id = check_login($username);
                if ($id) {
                    $_SESSION['account'] = array(
                        'is_login' => "TRUE",
                        'username' => $username,
                        'id' => $id,
                    );
                    redirect("?mod=post&controller=post&action=index");
//                show_array($_SESSION);
                } else {
                    $error['login'] = "Tài khoản chưa active. Vui lòng click  <a href=https://www.google.com.vn/>vào đây</a> để xác nhận";
                }
            } else {
                $error['login'] = "Tên đăng  nhập hoặc mật khẩu không đúng. Vui lòng thử lại";
            }
        }
    }
    $data['title_page'] = "Đăng nhập";
    load_view('login');
}

function logoutAction() {
    load_view('logout');
    redirect("?mod=account&controller=index&action=login");
}
