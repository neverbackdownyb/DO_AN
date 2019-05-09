<?php

function create_pagination($current_page, $total, $base_url, $cat_id = '', $price_search = '', $name_search = '') {
    //Nếu có biến status thì gán cho biến $status 1 giá trị
    //Nếu có biến search thì gán cho mó 1 giá trị
    if ($cat_id != '') {
        $cat_id = '&id=' . $cat_id;
    }
    if ($name_search != '') {
        $name_search = '&name_search=' . $name_search;
    }
    if ($price_search != 0) {
        $price_search = '&price_search=' . $price_search;
    } else {
        $price_search = '';
    }
   
    $html = '<div class="section" id="pagination-wp">
        <div class="wp-inner">
            <div class="pagination">';
    //số trang =1 thì không hiện ra
    if ($total > 1) {
        if ($total <= 10) {
            //Tổng số trang mà nhỏ hơn 10 thì in ra 10 trang luôn.
            for ($i = 1; $i <= $total; $i++) {
                //Nếu là trang hiện hành thì cho class = active vào
                $class_active = '';
                if ($current_page == $i) {
                    $class_active = "class='active_pagination'";
                }
                $html .= "<a $class_active href='" . $base_url . "&page=" . $i . $cat_id . $name_search . $price_search . "' title=''>" . $i . "</a>";
            }
        } else if ($total > 10) {
            //Nếu trang hiện hành nhỏ hơn hoặc bằng 5 thì in ra dạng như sau 1234567...10,11
            if ($current_page <= 5) {
                for ($i = 1; $i <= 5 + 2; $i++) {
                    //Nếu là trang hiện hành thì cho class = active vào
                    $class_active = '';
                    if ($current_page == $i) {
                        $class_active = "class='active_pagination'";
                    }
                    $html .= "<a $class_active href='" . $base_url . "&page=" . $i . $cat_id . $name_search . $price_search . "' title=''>" . $i . "</a>";
                }
                $html .= "<a title=''>...</a>";
                $html .= "<a href='" . $base_url . "&page=" . ($total - 1) . $cat_id . $name_search . $price_search . "' title=''>" . ($total - 1) . "</a>";
                $html .= "<a href='" . $base_url . "&page=" . $total . $cat_id . $name_search . $price_search . "' title=''>" . $total . "</a>";
            } else if (5 < $current_page && $current_page < $total - 4) {
                //Trường hợp còn lại ở giữa in ra phân trang dạng 12..7,8,9,10,11..t-1,t;
                //Vòng lạp ở đây in ra tất cả 5 cái. 2*2 cái rìa nó và chính nó(trang hiện hành)
                $html .= "<a href='" . $base_url . "&page=1" . $cat_id . $name_search . $price_search . "' title=''>1</a>";
                $html .= "<a href='" . $base_url . "&page=2" . $cat_id . $name_search . $price_search . "' title=''>2</a>";
                $html .= "<a title=''>...</a></li>";
                for ($i = ($current_page - 2); $i <= ($current_page + 2); $i++) {
                    //Nếu là trang hiện hành thì cho class = active vào
                    $class_active = '';
                    if ($current_page == $i) {
                        $class_active = "class='active_pagination'";
                    }
                    $html .= "<a $class_active href='" . $base_url . "&page=" . $i . $cat_id . $name_search . $price_search . "' title=''>" . $i . "</a></li>";
                }
                $html .= "<a title=''>...</a>";
                $html .= "<a href='" . $base_url . "&page=" . ($total - 1) . $cat_id . $name_search . $price_search . "' title=''>" . ($total - 1) . "</a>";
                $html .= "<a href='" . $base_url . "&page=" . $total . $cat_id . $name_search . $price_search . "' title=''>" . $total . "</a>";
            } else if ($current_page >= $total - 4) {
                //Trang hiện tại lớn hơn hoặc bàng t - 4. 1,2...t-6,t-5,t-4,t-3,t-2,t-1,t.
                $html .= "<a href='" . $base_url . "&page=1" . $cat_id . $name_search . $price_search . "' title=''>1</a>";
                $html .= "<a href='" . $base_url . "&page=2" . $cat_id . $name_search . $price_search . "' title=''>2</a>";
                $html .= "<a title=''>...</a>";
                for ($i = $total - 6; $i <= $total; $i++) {
                    //Nếu là trang hiện hành thì cho class = active vào
                    $class_active = '';
                    if ($current_page == $i) {
                        $class_active = "class='active_pagination'";
                    }
                    $html .= "<a $class_active href='" . $base_url . "&page=" . $i . $cat_id . $name_search . $price_search . "' title=''>" . $i . "</a>";
                }
            }
        }
    }
    $html .= "</div>
        </div>
    </div>";
    return $html;
}


    
?>