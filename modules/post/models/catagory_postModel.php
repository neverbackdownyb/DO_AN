<?php 


/*
 * Hàm lấy trả về id con dựa theo id cha
 */

function get_child_id_by_parent_id_post($id) {
    $sql = "SELECT id FROM catagory_post WHERE parent_id = '{$id}'";
    $data = db_fetch_array($sql);
    foreach ($data as $item) {
        $result[] = $item['id'];
    }
    return $result;
}

/*
 * Hàm lấy ra danh sách sản phẩm cùng danh mục
 */
function get_list_product_same_catagory_post($id){
//    echo $id; exit;
      $sql = "SELECT page_post .*, media.link"
            . " FROM page_post LEFT JOIN media ON page_post.id_media = media.id"
            . " WHERE page_post.cat_post_id IN ({$id}) AND page_post.type = 'post' AND page_post.status='active'";
       $result = db_fetch_array($sql);
       foreach ($result as &$a){
           $a['link'] = "admin/".$a['link'];
           $a['created_at'] = date('H:i d-m-Y', $a['created_at']);
           $a['detail_post'] = "?mod=post&controller=post&action=detail_post&id=".$a['id'];
       }
       return $result;
      
}
/*
 *  Ham lấy ra tên danh mục dựa theo id
 */
function get_title_catagory_post($id){
    $sql = "SELECT catagory FROM catagory_post WHERE id = '{$id}'";
    $data = db_fetch_row($sql);
    $result = $data['catagory'];
    return $result;
}