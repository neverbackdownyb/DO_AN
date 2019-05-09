<?php

//Hàm thêm mới 1 sản phẩm vào giỏ hàng
function add_to_cart($id) {
    $item = get_info_product_by_id($id);
    $qty = 1;
    if (isset($_SESSION['cart']['buy'][$id])) {
//        exit;
       
        $qty += $_SESSION['cart']['buy'][$id]['qty'];
    }

    //Thêm các thông tin của sản phẩm có id vào giỏ hang
    $_SESSION['cart']['buy'][$id] = array(
        'id' => $id,
        'code' => $item['product_code'],
        'title' => $item['title'],
        'price' => $item['price'],
        'price_affter_sale' => $item['price_affter_sale'],
//        'disscount' => $item['discount'],
        'qty' => $qty,
        'sub_total' => $qty * $item['price_affter_sale'],
        'url_image' => 'admin/' . $item['link'],
        'url_detail_product' => '?mod=product&controller=index&action=detail&id=' . $item['id'],
        'url_delete_cart' => '?mod=cart&controller=index&action=delete&id=' . $item['id'],
    );
    update_info_cart();
}

/*
 * Hàm cập nhật số lượng trong giỏ hàng.
 */

function update_qty_cart($data) {
    if (!empty($data)) {
        foreach ($data as $key => $value) {
            if (isset($_SESSION['cart']['buy'][$key])) {
                //Kiểm tra nếu số lượng bằng 0 thì xóa luôn sản phẩm ra khỏi giỏ hàng
                if($value == '0') {
                    unset($_SESSION['cart']['buy'][$key]);
                } else if(validate_int($value)) {
                    //Là một số thì mới cập nhật số lượng
                    $_SESSION['cart']['buy'][$key]['qty'] = $value;
                } 
            }
        }
    }
    update_info_cart();
}

/*
 * Hàm cập nhật số lượng và tổng số tiền của đơn hàng
 */

function update_info_cart() {
    $qty = 0;
    $total = 0;
    //Lặp các sản phẩm có trong giỏ hàng để tính tổng số sản phẩm và tông số tiền
    if (isset($_SESSION['cart']['buy'])) {
        foreach ($_SESSION['cart']['buy'] as $item) {
            $qty += $item['qty'];
            $total += $item['qty'] * $item['price_affter_sale'];
        }
    }

    //Cập nhật lại tổng số tiền
    $_SESSION['cart']['info'] = array(
        'qty' => $qty,
        'total' => $total,
    );
}

//Hàm lấy danh sách các sản phẩm có trong giỏ hàng.
function get_list_item_cart() {
    if (isset($_SESSION['cart']['buy']))
        return $_SESSION['cart']['buy'];
    return false;
}

//Hàm lấy thông tin trong giỏ hàng
function get_info_cart() {
    if (isset($_SESSION['cart']['info']))
        return $_SESSION['cart']['info'];
    return false;
}

//Hàm xóa 1 sản phẩm trong giỏ hàng đi
function delete_cart_by_id($id) {
    if (isset($_SESSION['cart']['buy'][$id])) {
        unset($_SESSION['cart']['buy'][$id]);
    }
    update_info_cart();
}

//Hàm xóa tất cả các sản phẩm trong giỏ hàng.
function delete_cart() {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}

//Hàm lấy thông tin admin theo id
function get_info_product_by_id($id) {
    $sql = "SELECT product.*, media.link FROM product INNER JOIN media ON product.id_media = media.id WHERE product.id = $id";
    return db_fetch_row($sql);
}
?>