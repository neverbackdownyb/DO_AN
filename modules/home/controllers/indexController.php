<?php

//domain.com?mod=home&controller=index&action=index

function construct() {
    load_model('home');
}

function searchAction() {
    $name_search = isset($_GET['name_search']) ? $_GET['name_search'] : '';
    $page = isset($_GET['page']) ? $_GET['page'] : 1;


    //Phân trang
    load('helper', 'pagination');
    $total_record = count_product_search($name_search);

    $num_per_page = 8;
    $total_page = ceil($total_record / $num_per_page);
    $start = ($page - 1) * $num_per_page;
    //Lấy danh sách sản phẩm
    $list_product = get_list_product_by_search($name_search, $start, $num_per_page);
    $data['list_product'] = $list_product;

    //Lấy đoạn html phân trang
    $base_url = base_url('?mod=home&controller=index&action=search');
    $html_pagination = create_pagination($page, $total_page, $base_url, '', '', $name_search);
    $data['html_pagination'] = $html_pagination;

    $data['name_search'] = $name_search;
    $data['total_record'] = $total_record;
    $data['title_page'] = "Tìm kiếm";

    load_view('search', $data);
}

function indexAction() {
//    load('helper', 'menu');
    $list_products = array();
    $list_posts = array();
    $list_product_discount = list_product_discount();
    //Lấy danh sách các hiển thị ra trang chủ;
    $list_show_home = list_show_home();
//    show_array($list_show_home);
    //lặp danh sách display để lấy mảng danh sách product hay post theo id connect
    foreach ($list_show_home as $display) {
        if ($display['type_connect'] == 'cat_product') {
            $list_products[$display['title']] = get_list_item_by_id_connect($display['type_connect'], $display['id_connect']);
        } else if ($display['type_connect'] == 'cat_post') {
            $list_posts[$display['title']] = get_list_item_by_id_connect($display['type_connect'], $display['id_connect']);
        }
    }

    $data['list_product_discount'] = $list_product_discount;
    $data['list_products'] = $list_products;
    $data['list_posts'] = $list_posts;
    $data['list_slider'] = get_list_slider();
    $data['title_page'] = "Trang chủ";

    load_view('index', $data);
}
