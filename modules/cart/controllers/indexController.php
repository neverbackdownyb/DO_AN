<?php

function construct() {
    load_model('index');
}

function addAction() {
    $id = (int) (isset($_GET['id']) ? $_GET['id'] : '');
    add_to_cart($id);
    redirect("?mod=cart&controller=index&action=show_cart");
}

function check_outAction() {
    global $data,$error;
    $data['list_show_cart'] = isset($_SESSION['cart']['buy']) ? $_SESSION['cart']['buy'] : "";
    $data['info_cart'] = isset($_SESSION['cart']['info']) ? $_SESSION['cart']['info'] : "";
    
    $user_info = $_POST;
    $list_item_cart = $_SESSION['cart']['buy'];
    $info_cart = $_SESSION['cart']['info'];
    
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Kiểm tra họ tên
        if(empty($_POST['fullname'])){
            $error['fullname'] = "Bạn cần điền đầy đủ họ tên";
        }  else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra email
        if(empty($_POST['email'])){
            $error['email'] = "Bạn cần điền vào email";
        }  else {
            $email = $_POST['email'];
        }
        //Kiểm tra address
        if(empty($_POST['address'])){
            $error['address'] = "Bạn cần điền vào address";
        }  else {
            $address = $_POST['address'];
        }
        //Kiểm tra phone
        if(empty($_POST['phone'])){
            $error['phone'] = "Bạn cần điền vào phone";
        }  else {
            $phone = $_POST['phone'];
        }
        //Kiểm tra notes
        if(empty($_POST['note'])){
            $error['note'] = "Bạn cần điền vào  phần ghi chú";
        }  else {
            $note= $_POST['note'];
        }
        //Kiểm tra phone
        if(empty($_POST['payment-method'])){
            $error['payment-method'] = "Bạn cần điền vào hình thức thanh toán";
        }  else {
            $payment_methods= $_POST['payment-method'];
        }
        //Nếu không có lỗi thì ta gửi mail. Khi gửi mail thành công thì mới bắt đầu thêm vào bảng order và order_detail
        if (empty($error)) {
            //Gủi mail
            load('helper', 'sendmail');
            $user_info = $_POST; //Lấy thông tin của khách hàng để gửi 
            $content = html_content_email($list_item_cart, $info_cart, $user_info);
            $subject = 'Thông tin đơn hàng';
            if (send_mail($user_info, $subject, $content)) {
//                Khi gửi mail thành công thì thêm vào bảng đơn hàng và chi tiết đơn hàng và thông tin khách hàng
                //Thêm vào bảng 
                
//                $data['kind_pay'] = $kind_pay;
//                $data['status'] = 'pendding';
//                $data['total'] = $info_cart['total'];
//                $data['qty'] = $info_cart['qty'];
//                $data['created_at'] = time();
//                if (add_order($data, $list_item_cart)) {
//                    delete_cart();
//                    flash_data('<p style="text-align: center" class="success">Đặt hàng thành công. Một email đã được gửi đên bạn. Bạn vui lòng kiểm tra để biết chi tiêt.</p>');
//                    redirect('?mod=cart&controller=index&action=show_cart');
//                } else {
//                    flash_data('<p style="text-align: center" class="error">Có lỗi hệ thống (Không thêm được). Không thể mua hàng được. Rất xin lỗi vì sự bất tiện này.</p>');
//                    redirect('?mod=cart&controller=index&action=show_cart');
//                }
            }
             else {
                //Không gửi được mail thì thông báo lỗi cho người dùng biết.
                flash_data('<p style="text-align: center" class="error">Có lỗi hệ thống (Không gửi được email). Không thể mua hàng được. Rất xin lỗi vì sự bất tiện này.</p>');
                redirect('?mod=cart&controller=index&action=show_cart');
            }
        }
    }
    load_view('check_out', $data);
}

function deleteAction($id) {
    $id = (int) (isset($_GET['id']) ? $_GET['id'] : '');
    delete_cart_by_id($id);
    redirect("?mod=cart&controller=index&action=show_cart");
}

function delete_cartAction() {
    delete_cart();
    redirect("?mod=cart&controller=index&action=show_cart");
}

function update_cartAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = $_POST['num-order'];
        foreach ($data as $key => $value) {
            if (isset($_SESSION['cart']['buy'][$key])) {
                if (!is_numeric($v)) {
                    if ($value == 0) {
                        unset($_SESSION['cart']['buy'][$key]);
                    } else {
                        $_SESSION['cart']['buy'][$key]['qty'] = $value;
                        $_SESSION['cart']['buy'][$key]['sub_total'] = $value * $_SESSION['cart']['buy'][$key]['price_affter_sale'];
                    }
                } else {
                    echo "không phải số";
                }
            }update_info_cart();
        }
    }
    redirect("?mod=cart&controller=index&action=show_cart");
}

function show_cartAction() {
    $id = (int) (isset($_GET['id']) ? $_GET['id'] : "");
    if ($id > 0) {
        add_to_cart($id);
        redirect("?mod=cart&controller=index&action=show_cart");
    }
    if ($_SERVER['REQUEST_METHOD'])
        $data['list_show_cart'] = isset($_SESSION['cart']['buy']) ? $_SESSION['cart']['buy'] : "";
    $data['info_cart'] = isset($_SESSION['cart']['info']) ? $_SESSION['cart']['info'] : "";
    $data['title_page'] = "Giỏ hàng";

    load_view('show_cart', $data);
}
