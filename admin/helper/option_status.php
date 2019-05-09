<?php

function get_option_by_status($status) {
    //tác vụ
    $post_status = array(
        '' => array(
            'active' => 'Kích hoạt',
            'pendy' => 'Chờ duyệt',
            'bin' => 'Thùng rác',
            'destroy' => 'Xóa vĩnh viễn',
        ),
        'active' => array(
            'pendy' => 'Chờ duyệt',
            'bin' => 'Thùng rác',
            'destroy' => 'Xóa vĩnh viễn',
        ),
        'pendy' => array(
            'active' => 'Kích hoạt',
            'bin' => 'Thùng rác',
            'destroy' => 'Xóa vĩnh viễn',
        ),
        'bin' => array(
            'active' => 'Kích hoạt',
            'pendy' => 'Chờ duyệt',
            'destroy' => 'Xóa vĩnh viễn',
        )
    );
    if (array_key_exists($status, $post_status))
        return $post_status[$status];
    return FALSE;
}

function get_option_by_status_for_post($status) {
    //tác vụ
    $post_status = array(
        '' => array(
            'active' => 'Hoạt động',
            'pendy' => 'Chờ duyệt',
            'bin' => 'Thùng rác',
        ),
        'active' => array(
            'pendy' => 'Chờ duyệt',
            'bin' => 'Thùng rác',
        ),
        'pendy' => array(
            'active' => 'Hoạt động',
            'bin' => 'Thùng rác',
        ),
        'bin' => array(
            'active' => 'Hoạt động',
            'pendy' => 'Chờ duyệt',
            'destroy' => 'Xóa',
        )
    );
    if (array_key_exists($status, $post_status))
        return $post_status[$status];
    return FALSE;
}
