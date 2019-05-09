<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

function construct() {
    load_model('index');
}

function indexAction() {
    global $error;
    $catagory_product = list_catagory_product();
    $catagory_post = list_catagory_post();
    $list_page = get_list_page();
    $list_menu = get_list_menu();
    $list_type_menu = get_type_menu();

    if (isset($_POST['sm_add'])) {
        $error = array();
        $data = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên menu ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['type_menu'])) {
            $error['type_menu'] = "Không được để trống loại menu ";
        } else {
            $id_type_menu = $_POST['type_menu'];
        }

        if (isset($_POST['parent_id'])) {
            $parent_id = $_POST['parent_id'];
        }

        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "Không được để trống số thứ tự ";
        } else {
            $menu_order = $_POST['menu_order'];
        }

        //Kiểm tra xem có tồn tại 1 trong 4 trường . Rồi gán giá trị cho trường.
        if (empty($_POST['post_id'])) {
            if (empty($_POST['product_id']) && empty($_POST['page_slug']) && empty($_POST['url_static'])) {
                $error['empty'] = "Bạn cần chọn 1 trong 4 trường";
            }
        } else {
            $id_connect = $_POST['post_id'];
            $type_connect = "cat_post";
            $static_link = NULL;
        }

        if (empty($_POST['product_id'])) {
            if (empty($_POST['post_id']) && empty($_POST['page_slug']) && empty($_POST['url_static'])) {
                $error['empty'] = "Bạn cần chọn 1 trong 4 trường";
            }
        } else {
            $id_connect = $_POST['product_id'];
            $type_connect = "cat_product";
            $static_link = NULL;
        }

        if (empty($_POST['page_slug'])) {
            if (empty($_POST['post_id']) && empty($_POST['product_id']) && empty($_POST['url_static'])) {
                $error['empty'] = "Bạn cần chọn 1 trong 4 trường";
            }
        } else {
            $id_connect = $_POST['page_slug'];
            $type_connect = "page";
            $static_link = NULL;
        }

        if (empty($_POST['url_static'])) {
            if (empty($_POST['post_id']) && empty($_POST['product_id']) && empty($_POST['page_slug'])) {
                $error['empty'] = "Bạn cần chọn 1 trong 4 trường";
            }
        } else {
            $id_connect = NULL;
            $type_connect = NULL;
            $static_link = $_POST['url_static'];
        }
        if (empty($error)) {
            $data_insert = array(
                'title' => $title,
                'static_link' => $static_link,
                'type_connect' => $type_connect,
                'id_connect' => $id_connect,
                'id_type_menu' => $id_type_menu,
                'order_num' => $menu_order,
                'parent_id' => $parent_id,
            );
            if (db_insert('menu', $data_insert)) {
                flash_data("<p class ='message_success' >Thêm menu thành công </p>");
                $data['message'] = get_flash_data();
                redirect("?mod=menu&controller=index&action=index");
            }
        }
    }

    $data['title_page'] = "Danh sách menu";
    $data['catagory_product'] = $catagory_product;
    $data['catagory_post'] = $catagory_post;
    $data['list_menu'] = $list_menu;
    $data['type_menu'] = $list_type_menu;
    $data['message'] = get_flash_data();
    $data['list_page'] = $list_page;
    load_view('index', $data);
}

function editAction() {
    global $error;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_menu_by_id = get_menu_by_id($id);

    $catagory_product = list_catagory_product();
    $catagory_post = list_catagory_post();
    $list_page = get_list_page();
    $list_menu = get_list_menu();
    $list_type_menu = get_type_menu();
    if (isset($_POST['sm_add'])) {
        $error = array();
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tên menu ";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['type_menu'])) {
            $error['type_menu'] = "Không được để trống loại menu ";
        } else {
            $type_menu = $_POST['type_menu'];
        }

        if (isset($_POST['parent_id'])) {
            $parent_id = $_POST['parent_id'];
        }

        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "Không được để trống số thứ tự ";
        } else {
            $menu_order = $_POST['menu_order'];
        }

        //Kiểm tra xem có tồn tại 1 trong 4 trường . Rồi gán giá trị cho trường.
        if (empty($_POST['post_id'])) {
            if (empty($_POST['product_id']) && empty($_POST['page_slug']) && empty($_POST['url_static'])) {
                $error['empty'] = "Bạn cần chọn 1 trong 4 trường";
            }
        } else {
            $id_connect = $_POST['post_id'];
            $type_connect = "cat_post";
            $static_link = NULL;
        }

        if (empty($_POST['product_id'])) {
            if (empty($_POST['post_id']) && empty($_POST['page_slug']) && empty($_POST['url_static'])) {
                $error['empty'] = "Bạn cần chọn 1 trong 4 trường";
            }
        } else {
            $id_connect = $_POST['product_id'];
            $type_connect = "cat_product";
            $static_link = NULL;
        }

        if (empty($_POST['page_slug'])) {
            if (empty($_POST['post_id']) && empty($_POST['product_id']) && empty($_POST['url_static'])) {
                $error['empty'] = "Bạn cần chọn 1 trong 4 trường";
            }
        } else {
            $id_connect = $_POST['page_slug'];
            $type_connect = "page";
            $static_link = NULL;
        }

        if (empty($_POST['url_static'])) {
            if (empty($_POST['post_id']) && empty($_POST['product_id']) && empty($_POST['page_slug'])) {
                $error['empty'] = "Bạn cần chọn 1 trong 4 trường";
            }
        } else {
            $id_connect = NULL;
            $type_connect = NULL;
            $static_link = $_POST['url_static'];
        }
        if (empty($error)) {
            $data_update = array(
                'title' => $title,
                'static_link' => $static_link,
                'type_connect' => $type_connect,
                'id_connect' => $id_connect,
                'id_type_menu' => $type_menu,
                'order_num' => $menu_order,
                'parent_id' => $parent_id,
            );
            $id_update = db_update('menu', $data_update, "id = '{$id}'");
            
//            echo $id_update;exit;
            if ($id_update >= 0) {
                flash_data("<p class='message_success'> Cập nhật thành công </p>");
                redirect("?mod=menu&controller=index&action=index");
            }
        }
    }
    $data['title_page'] = "Chỉnh sửa menu";

    $data['menu'] = $get_menu_by_id;
    $data['catagory_product'] = $catagory_product;
    $data['type_menu'] = $list_type_menu;
    $data['catagory_post'] = $catagory_post;
    $data['list_menu'] = $list_menu;
    $data['list_page'] = $list_page;
    $data['message'] = get_flash_data();
    load_view('edit', $data);
}

function deleteAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $menu = get_menu_by_id($id);
    $get_parent_id_menu = get_parent_id_menu($id);

    if ($get_parent_id_menu) {
        flash_data("<p class='message_error'>Phải xóa hết danh mục con mới xóa danh mục cha</p>");
        redirect("?mod=menu&controller=index&action=index");
    } else {
        if (db_delete('menu', "id='{$id}'")) {
            flash_data("<p class='message_success'>Xóa thành công </p>");
            redirect("?mod=menu&controller=index&action=index");
        }
    }
}

function add_type_menuAction() {
    global $error;

    $admin = info_admin();
    if (isset($_POST['submit_add'])) {
        $error = array();
        $parent_cat = $_POST['parent_cat'];

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
                redirect("?mod=menu&controller=index&action=type_menu");
            }
        }
    }
    $data['title_page'] = "Thêm loại menu";
    $data['list_type_menu'] = get_list_type_menu();
    load_view('add_type_menu', $data);
}

function taskAction() {
    $admin = info_admin();
    if (!empty($_POST['post_status'])) {
        $option = $_POST['post_status'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            $id = $array_id;
            $menu = get_menu_by_id($id);
            show_array($menu);
            if ($option == "destroy") {
                if (db_delete('menu', "id IN ({$array_id})")) {
                    $data_history = array(
                        'created_by' => $admin['username'],
                        'action' => "Xóa ",
                        'content' => $menu['title'],
                        'catagory' => 'menu',
                        'created_at' => time(),
                    );
                    db_insert('history', $data_history);
                    flash_data("<p class='message_success'>Xóa bài viết thành công ! </p>");
                    redirect("?mod=menu&controller=index&action=index");
                }
            }
        } else {
            flash_data("<p class=''> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=menu&controller=index&action=index");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=menu&controller=index&action=index");
    }
}
