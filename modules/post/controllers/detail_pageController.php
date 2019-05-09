<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

function construct() {
    load_model('detail_page');
}

function detail_pageAction() {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $get_page = get_page_by_id($id);

//   show_array($get_page);
    $data['title_page'] = "Chi tiết trang";
    $data['page'] = $get_page;
    load_view('detail_page', $data);
}
