<?php

//domain.com?mod=home&controller=index&action=index

function construct() {
    load_model('product');
    load_model('cat_product');
    load_model('price');
}

function add_productAction() {
    global $error, $title, $code, $excerpt, $slug, $desc, $price, $id_media, $cat_id, $qty, $sale_of, $disscount, $price_range;
    $list_catagory = list_catagory_product();

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
            $error['slug'] = "Không được để trống slug ";
        } else {
            $slug = $_POST['slug'];
        }

        if (empty($_POST['code'])) {
            $error['code'] = "Không được để trống mã sản phầm ";
        } else {
            $code = $_POST['code'];
        }

        if (empty($_POST['price_range'])) {
            $error['price_range'] = "Không được để trống khoảng giá ";
        } else {
            $price_range = $_POST['price_range'];
        }

        if (empty($_POST['price'])) {
            $error['price'] = "Bạn chưa điền vào giá sản phẩm";
        } else {
            $str = $_POST['price'];
            $price = to_price($str);
        }

        if (!empty($_POST['price_affter_sale'])) {
            $str = $_POST['price_affter_sale'];
            $price_affter_sale = to_price($str);
        }

        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được để trống chi tiết sản phẩm";
        } else {
            $desc = $_POST['desc'];
        }

        if (empty($_POST['excerpt'])) {
            $error['excerpt'] = "Không được để trống phần mô tả";
        } else {
            $excerpt = $_POST['excerpt'];
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

        if (empty($_POST['qty'])) {
            $error['qty'] = "Không được để trống số lượng";
        } else {
            $qty = $_POST['qty'];
        }

        if (!empty($_POST['disscount'])) {
            if (!empty($_POST['sale_off'])) {
                $sale_off = $_POST['sale_off'];
                $disscount = "";
            } else {
                $disscount = $_POST['disscount'];
                $sale_off = "";
            }
        } else {
            if (!empty($_POST['sale_off'])) {
                $sale_off = $_POST['sale_off'];
                $disscount = "";
            } else {
                $sale_off = "";
                $disscount = "";
            }
        }

        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống trạng thái";
        } else {
            $status = $_POST['status'];
        }


        if (empty($error)) {
            $data = array(
                'title' => $title,
                'product_code' => $code,
                'price_range' => $price_range,
                'price' => $price,
                'price_affter_sale' => $price_affter_sale,
                'description' => $desc,
                'excerpt' => $excerpt,
                'id_media' => $id_media,
                'disscount' => $disscount,
                'sale_off' => $sale_off,
                'qty_total' => $qty,
                'created_at' => time(),
                'status' => $status,
                'created_by' => $admin['username'],
                'cat_product_id' => $cat_id,
            );
            $id_product = insert_product($data);
            $data_media = array(
                'id_connect' => $id_product,
                'type' => 'product');
            if ($id_product) {
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Thêm mới",
                    'content' => $title,
                    'catagory' => 'sản phẩm',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                db_update('media', $data_media, "id='{$id_media}'");
                flash_data("<p class='message_success'>Thêm mới bài viết thành công</p>");
                redirect("?mod=product&controller=product&action=index");
            }
        }
    }
    $data['list_price'] = get_list_price();
    $data['title_page'] = "Thêm mới sản phẩm";
    $data['list_catagory'] = $list_catagory;
    load_view('add_product', $data);
}

function edit_productAction() {
    global $error;
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_product_by_id = get_product_by_id($id);
    $list_catagory_product = list_catagory_product();
    $data['list_catagory_product'] = $list_catagory_product;
    $admin = info_admin();

    $product = get_product_by_id($id);
    if (isset($_POST['submit_add'])) {
        $error = array();

        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống tiêu đề";
        } else {
            $title = $_POST['title'];
        }

        if (empty($_POST['price_range'])) {
            $error['price_range'] = "Không được để trống khoảng giá ";
        } else {
            $price_range = $_POST['price_range'];
        }


        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống giá sản phẩm";
        } else {
            $str = $_POST['price'];
            $price = to_price($str);
        }

        if (!empty($_POST['price_affter_sale'])) {
            $str = $_POST['price_affter_sale'];
            $price_affter_sale = to_price($str);
        }

        if (!empty($_POST['disscount'])) {
            if (!empty($_POST['sale_off'])) {
                $sale_off = $_POST['sale_off'];
                $disscount = "";
            } else {
                $disscount = $_POST['disscount'];
                $sale_off = "";
            }
        } else {
            if (!empty($_POST['sale_off'])) {
                $sale_off = $_POST['sale_off'];
                $disscount = "";
            } else {
                $sale_off = "";
                $disscount = "";
            }
        }

        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Không được để trống mã sản phẩm";
        } else {
            $product_code = $_POST['product_code'];
        }

        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được để trống mô tả";
        } else {
            $desc = $_POST['desc'];
        }
        
        if (empty($_POST['excerpt'])) {
            $error['excerpt'] = "Không được để trống mô tả";
        } else {
            $excerpt = $_POST['excerpt'];
        }

        if (empty($_POST['id_media'])) {
            $error['id_media'] = "Bạn chưa chọn hình ảnh";
        } else {
            $id_media = $_POST['id_media'];
        }

        if (empty($_POST['cat_product_id'])) {
            $error['cat_product_id'] = "Bạn chưa chọn danh mục";
        } else {
            $cat_product_id = $_POST['cat_product_id'];
        }

        if (empty($error)) {
            $data = array(
                'title' => $title,
                'product_code' => $product_code,
                'price' => $price,
                'price_range' => $price_range,
                'price_affter_sale' => $price_affter_sale,
                'disscount' => $disscount,
                'excerpt' => $excerpt,
                'sale_off' => $sale_off,
                'description' => $desc,
                'id_media' => $id_media,
                'cat_product_id' => $cat_product_id,
                'created_at' => time(),
                'created_by' => $admin['username'],
            );
//            show_array($data);
//            show_array($get_product_by_id);
//            exit;
            if (update_product_by_id($id, $data)) {
                if ($get_product_by_id['id_media'] != $id_media) {
                    //Xóa bản ghi cũ trong media
                    db_delete('media', "id = '{$get_product_by_id['id_media']}'");
                    // Đồng thời cập nhật dữ liệu mới. và xóa 
                    $data_media_new = array(
                        'type' => 'product',
                        'id_connect' => $id,
                    );
                    db_update('media', $data_media_new, "id='{$id_media}'");
                    //Xóa ảnh cũ trong thư mục
                    if (file_exists($get_product_by_id['link'])) {
                        unlink($get_product_by_id['link']);
                    }
                }
                //Cập nhật thành công thì thêm dữ liệu chỉnh sửa vào bảng history;
                $data_history = array(
                    'created_by' => $admin['username'],
                    'action' => "Chỉnh sửa",
                    'content' => $get_product_by_id['title'],
                    'catagory' => 'sản phẩm',
                    'created_at' => time(),
                );
                db_insert('history', $data_history);
                flash_data("<p class='message_success'> Cập nhật thông tin sản phầm thành công <p> ");
                redirect("?mod=product&controller=product&action=index");
            }
        }
    }
    $data['list_price'] = get_list_price();
    $product = get_product_by_id($id);
    $data['title_page'] = "Chỉnh sửa sản phẩm";
    $data['product'] = $product;
    load_view('edit_product', $data);
}

function delete_productAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_product_by_id = get_product_by_id($id);
    $admin = info_admin();

    if (db_delete("product", "id= {$id}")) {
        //Thêm dữ liệu vào bảng history
        $data_history = array(
            'created_by' => $admin['username'],
            'action' => "Xóa",
            'content' => $get_product_by_id['title'],
            'catagory' => 'sản phẩm',
            'created_at' => time(),
        );
        db_insert('history', $data_history);
        //Xóa dữ liệu bản ghi trong bảng media
        db_delete('media', "id ={$get_product_by_id['id_media']}");
        //Xóa ảnh trong thư mục
        if (file_exists($get_product_by_id['link'])) {
            unlink($get_product_by_id['link']);
        }
        flash_data("<p class='message_success'> Xóa sản phẩm thành công <p>");
        redirect("?mod=product&controller=product&action=index");
    };
}

function indexAction() {
    load('helper', 'option_status');
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    //======================
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $number_per_page = 2; // Mỗi trang 3 người 
    $total_row = get_total_product(); // Tính tổng số người 


    $num_page = ceil($total_row / $number_per_page);

    $start = ($page - 1) * $number_per_page;

// Thanh phân trang
    $base_url_pagging = "?mod=product&controller=product&action=index";
    $html_pagging = create_pagging($num_page, $base_url_pagging, $page);
    $list_product = get_list_product($status, $search, $start, $number_per_page);


    //====================

    $option = get_option_by_status_for_post($status);
    $data['option'] = $option;

    $list_product = get_list_product($status, $search, $number_per_page, $start);
    $data['list_product'] = $list_product;

    $number_product = get_number_product($status);
    $data['status'] = $status;
    $data['search'] = $search;
    $data['title_page'] = "Danh sách sản phẩm";
    $data['number_product'] = $number_product;
    load_view('index', $data);
}

function taskAction() {
    $admin = info_admin();
//    $get_product_by_id = get_product_by_id($id);
//    show_array($get_product_by_id);exit;
    if (!empty($_POST['actions'])) {
        $option = $_POST['actions'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            $get_product_by_array_id = get_product_by_array_id($array_id);
          
//            show_array($get_product_by_array_id);exit;
            if ($option == "destroy") {
                if (db_delete("product", "id IN ({$array_id})")) {
                    //Thêm dữ liệu vào bảng history
                    foreach ($get_product_by_array_id as $k => $v) {
                        $data_history = array(
                            'created_by' => $admin['username'],
                            'action' => "Xóa",
                            'content' => $v['title'],
                            'catagory' => 'sản phẩm',
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
                    redirect("?mod=product&controller=product&action=index");
                }
            }
            if (update_task_for_product($option, $array_id)) {
                flash_data("<p class='message_success'> Cập nhật thông tin thành công ! </p>");
                redirect("?mod=product&controller=product&action=index");
            } else {
                flash_data("<p class =message_error> Cập nhật không thành công! </p>");
                redirect("?mod=product&controller=product&action=index");
            }
        } else {
            flash_data("<p class=''> Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=product&controller=product&action=index");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=product&controller=product&action=index");
    }
}
