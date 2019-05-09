<?php

function get_list_user() {
    $result = db_fetch_array('SELECT * FROM `admin`');
    return $result;
}

function get_total_product() {
    $result = db_fetch_row("SELECT COUNT(*) as 'total' FROM `product`");
    return $result['total'];
}

function create_pagging($num_page = 0,$base_url_pagging="",$current_page) {
    $pagging = "<ul class=\"pagging\">";
    for ($i = 1; $i <= $num_page; $i++) {
        $class_active="";
        if($current_page==$i){
            $class_active ="class='active'";
        }
        $pagging.=" <li {$class_active}><a href='{$base_url_pagging}&page={$i}'>{$i}</a></li>";
    }
    $pagging.="</ul>";
    return $pagging;
}

function add_post($data) {
    show_array($data);
    db_insert('catagory_post', $data);
}

function get_list_product($status, $search,$number_per_page,$start) {
//    echo $start;
//    Nếu status trống 
//    $sql ="SELECT page_post.*, catagory_post.catagory, media.link"
//            . " FROM page_post INNER JOIN catagory_post ON page_post.cat_post_id = catagory_post.id "
//            . " INNER JOIN media ON media.id=page_post.id_media "
//            . "WHERE page_post.type='post'";
    if (empty($status)) {
        if (empty($search)) {
            $sql = "SELECT product.*, catagory_product.catagory, media.link"
                    . " FROM product LEFT JOIN catagory_product ON product.cat_product_id = catagory_product.id "
                    . " LEFT JOIN media ON media.id=product.id_media  ORDER BY product.created_at DESC";
        } else {

            $sql = "SELECT product.*, catagory_product.catagory, media.link"
                    . " FROM product LEFT JOIN catagory_product ON product.cat_product_id = catagory_product.id "
                    . " LEFT JOIN media ON media.id=product.id_media  "
                    . "WHERE  product.title LIKE '%{$search}%' ORDER BY product.created_at DESC";
        }
    }
    //Tồn tại status
    else {
        if (empty($search)) {

            $sql ="SELECT product.*, catagory_product.catagory, media.link"
                    . " FROM product LEFT JOIN catagory_product ON product.cat_product_id = catagory_product.id "
                    . " LEFT JOIN media ON media.id=product.id_media "
                    . "WHERE product.status  = '{$status}' ORDER BY product.created_at DESC";
        } else {
            $sql ="SELECT product.*, catagory_product.catagory, media.link"
                    . " FROM product LEFT JOIN catagory_product ON product.cat_product_id = catagory_product.id "
                    . " LEFT JOIN media ON media.id=product.id_media "
                    . "WHERE product.title LIKE '%{$search}%' AND product.status  = '{$status}' ORDER BY product.created_at DESC";
        }
    }
    if(!empty($number_per_page) && !empty($start)){
            $sql .=" LIMIT $start,$number_per_page";
    }  
    $result = db_fetch_array($sql);
    foreach ($result as &$a) {

        $a['url_edit'] = "?mod=product&controller=product&action=edit_product&id={$a['id']}";
        $a['url_delete'] = "?mod=product&controller=product&action=delete_product&id={$a['id']}";
        $a['reg_at_fomat'] = date('H:i d-m-Y', $a['created_at']);
    }
//    $result = multi_data($result);
    return $result;
}

function get_number_product($status) {
    if (empty($status)) {
        return db_num_row("SELECT * FROM `product`");
    } else {
        return db_num_row("SELECT * FROM `product` WHERE status = '{$status}'");
    }
}

function get_product_by_array_id($array_id){
    $sql = "SELECT product.*, media.link"
            . " FROM product INNER JOIN media ON product.id_media = media.id "
            . "WHERE product.id IN ({$array_id})";
    $data = db_fetch_array($sql);
    foreach($data as $v){
        $result[] = $v;
    }
    return $result;
}

function insert_catagory_product($data) {
    if (db_insert('catagory_product', $data))
        return TRUE;
    return FALSE;
}

function update_product_by_id($id, $data) {
    if (db_update('product', $data, "id= '{$id}'"))
        return TRUE;
        return FALSE;
}

function update_task_for_product($option, $array_id) {
    $where = "id IN ({$array_id})";
    $data = array(
        'status' => $option,
    );
    if (db_update('product', $data, $where))
        ;
    return TRue;
    return FALSE;
}

function insert_product($data) {
    $id =(db_insert('product', $data)) ;
     if($id){
         return $id;
         return false;
     }
    
}

function get_product_by_id($id) {
    return db_fetch_row("SELECT product.*, catagory_product.catagory, media.link"
            . " FROM product LEFT JOIN catagory_product ON product.cat_product_id = catagory_product.id "
            . " LEFT JOIN media ON media.id=product.id_media "
            . "WHERE product.id= '{$id}'");
}
