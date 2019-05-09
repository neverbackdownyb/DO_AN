<?php

function get_page_by_id($id){
   $sql = "SELECT page_post .*, media.link "
           . " FROM page_post LEFT JOIN media ON page_post.id_media = media.id"
           . " WHERE page_post.id = '{$id}' AND page_post.type = 'page' AND page_post.status='active'";
   $result = db_fetch_row($sql);
   $result['created_at'] = date('H:i d-m-Y', $result['created_at']);
   return $result;
    
}