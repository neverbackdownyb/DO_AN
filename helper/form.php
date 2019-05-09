<?php
///Hàm hiển thị thông báo lỗi ở form
function form_error($field){
    global $error;
    if(isset($error[$field]))
        echo $error[$field];
}

//Hàm hiển thị giá trị người dùng đã nhập vào form
function set_value($field){
    global $$field;
    if(isset($$field))
        echo $$field;
}

function selected($param1, $param2) {
    $result = '';
    if ($param1 == $param2) {
        $result = "selected='selected'";
    }
    echo $result;
}

function selected_form($field,$value){
    global $$field;
    $result = '';
    if($$field==$value){
        $result ="selected= 'selected'";
    }
    echo $result;
}
