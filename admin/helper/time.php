<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
function get_date($time,$format='H:i - d/m/Y'){
    return date($format,$time);
}