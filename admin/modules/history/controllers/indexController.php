<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

function construct() {
    load_model('index');
}

function deleteAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    db_delete('history', "id={$id}");
    flash_data("<p class ='message_success'> Xóa lịch sử thành công </p>");
    redirect("?mod=history&controller=index&action=index");
}

function indexAction() {
    $search = isset($_GET['search']) ? $_GET['search'] : "";
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $search = isset($_GET['search']) ? $_GET['search'] : "";
    $number_per_page = 10; // Mỗi trang 3 người 
    $total_row = get_num_history(); // Tính tổng số người 

    $num_page = ceil($total_row / $number_per_page);

    $start = ($page - 1) * $number_per_page;

// Thanh phân trang
    $base_url_pagging = "?mod=history&controller=index&action=index";
    $html_pagging = create_pagging($num_page, $base_url_pagging, $page);

    $history = get_list_history($search, $start, $number_per_page);
    
    $data['message'] =  get_flash_data();
    $data['title_page'] = "Lịch sử";
    $data['history'] = $history;
    $data['html_pagging'] = $html_pagging;
    load_view('index', $data);
}

function taskAction() {
    if (!empty($_POST['actions'])) {
        $option = $_POST['actions'];
        if (isset($_POST['item_check_box'])) {
            $array_id = implode(",", $_POST['item_check_box']);
            if ($option == "delete") {
                if (db_delete("history", "id IN ({$array_id})")) {
                    flash_data("<p class='message_success'>Xóa lịch sử thành công ! </p>");
                    redirect("?mod=history&controller=index&action=index");
                }
            }
        } else {
            flash_data("<p class='' > Bạn chưa chọn phần checkbox </p>");
            redirect("?mod=history&controller=index&action=index");
        }
    } else {
        flash_data("<p class='message_error'>Bạn chưa chọn tác vụ</p>");
        redirect("?mod=history&controller=index&action=index");
    }
}
