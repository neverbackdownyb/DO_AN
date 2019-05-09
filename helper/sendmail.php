<?php

function send_mail($user_info, $subject, $content) {
    require 'plugins/phpMailer/PHPMailerAutoload.php';
//    echo 'email: ' .$email.'<br>';
//    echo 'fullname: ' .$fullname.'<br>';
//    echo 'content: ' .$content.'<br>';
//    echo 'subject: ' .$subject .'<br>';
//    echo $message.'<br>';
//    echo $redirect;
//    exit;

    global $send_email;

    $mail = new PHPMailer;
    $mail->CharSet = $send_email['charset'];

// $mail->SMTPDebug = 3;                             // Enable verbose debug output

    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Host = $send_email['smtp_host'];       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                             // Enable SMTP authentication
    $mail->Username = $send_email['smtp_user'];     // SMTP username
    $mail->Password = $send_email['smtp_pass'];             // SMTP password
    $mail->SMTPSecure = $send_email['protocol'];                          // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $send_email['smtp_port'];                                  // TCP port to connect to

    $mail->setFrom($send_email['smtp_user'], 'Adminstrator'); //Thiết lâp thông tin người gửi

    $mail->addAddress($user_info['email'], $user_info['fullname']);     // Add a recipient
    $mail->addReplyTo($send_email['smtp_user'], 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');
// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body = $content;



// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

//Hàm trả về nội dung chuỗi html gửi email đơn hàng
function html_content_email($list_item, $info_cart, $user_info) {
    $content = "
        <h1 style='font-size: 30px; color: #000; text-transform: uppercase; text-align: center;'>Thông tin đơn hàng</h1>
        <h2 style='font-size: 20px; color: #000; text-align: left;'>Thông tin khách hàng</h2>
        <table id='customer' style='text-align: left;margin-bottom: 30px;'>
            <tr >
                <td style='padding-bottom: 7px; padding-top: 7px;'>Tên</td>
                <td style='padding-left: 200px'>" . $user_info['fullname'] . "</td>
            </tr>
            <tr>
                <td style='padding-bottom: 7px; padding-top: 7px;'>Số điện thoại</td>
                <td style='padding-left: 200px'>" . $user_info['phone'] . "</td>
            </tr>
            <tr>
                <td style='padding-bottom: 7px; padding-top: 7px;'>Email</td>
                <td style='padding-left: 200px'>" . $user_info['email'] . "</td>
            </tr>
            <tr>
                <td style='padding-bottom: 7px; padding-top: 7px;'>Địa chỉ</td>
                <td style='padding-left: 200px'>" . $user_info['address'] . "</td>
            </tr>
        </table>
        <h2 style='font-size: 20px; color: #000; text-align: left;'>Chi tiết đơn hàng</h2>
        <table id='product' style='text-align: left;margin-bottom: 30px; width: 800px;border-bottom: 1px dotted #404040'>
            <thead>
                <tr>
                    <th style='padding: 7px 200px 7px 0;'>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá tiền(VNĐ)</th>
                    <th style='text-align: right'>Tổng cộng(VNĐ)</th>
                </tr>
            </thead>
            <tbody>";
    $i = 0;
    foreach ($list_item as $item) {
        $i++;
        if ($i % 2 == 0) {
            $class = "style='background: #e4e4e4'";
        } else {
            $class = "style='background: #c5c5c5'";
        }
        $content .= "<tr " . $class . ">
                    <td style='padding: 7px 200px 7px 0;' >" . $item['title'] . "</td>
                    <td>" . $item['qty'] . "</td>
                    <td>" . currency_format($item['price']) . "</td>
                    <td style='text-align: right'>" . currency_format($item['sub_total']) . "</td>
                </tr>";
    }

    $content .= " </tbody>
        </table>
        <table id='info' style='width: 800px'>
            <tr>
                <td style='padding: 10px 0;'>Thông tin đơn hàng:</td>
                <td style='text-align: right'>" . currency_format($info_cart['total']) . "</td>
            </tr>
            <tr style='background: #fbe0cd'>
                <td style='padding: 10px 0;'>Tổng số tiền đã thanh toán</td>
                <td style='text-align: right'>0</td>
            </tr>
        </table>";
    return $content;
}

?>
