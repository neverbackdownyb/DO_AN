<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Bước 1: Tạo thư mục lưu file
    $error = array();
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['file']['name']);
    // Kiểm tra kiểu file hợp lệ
    $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
    if (!in_array(strtolower($type_file), $type_fileAllow)) {
        $error['file'] = "File bạn vừa chọn hệ thống không hỗ trợ, bạn vui lòng chọn hình ảnh";
    }
    //Kiểm tra kích thước file
    $size_file = $_FILES['file']['size'];
    if ($size_file > 5242880) {
        $error['file'] = "File bạn chọn không được quá 5MB";
    }
// Kiểm tra file đã tồn tại trê hệ thống
    if (file_exists($target_file)) {
        $error['file'] = "File bạn chọn đã tồn tại trên hệ thống";
    }
//
    if (empty($error)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "Bạn đã upload file thành công";
            $flag = true;
        } else {
            echo "File bạn vừa upload gặp sự cố";
        }
    }
}
?>
<html>
    <head>
        <title>Upload file Ajax</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="js/customs.js" type="text/javascript"></script>
        <meta charset="utf-8">
    </head>
    <body>
        <style>
            #show_list_file { width:  200px; height: 200px; overflow: hidden;}
            #show_list_file img { max-width: 100%; max-height: 100%;}
        </style>
        <form id="form-upload-single"  action="" enctype="multipart/form-data" method="post">
            <div class="form_group clearfix">
                <label for="detail">Hình ảnh</label><br/><br/>
                <input type="file" name="file" id="file" data-uri="upload_single.php"><br/><br/>
                <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
            </div>
        </form>
        <div id="show_list_file" >
            
        </div>
    </body>
</html>