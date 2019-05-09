<?php
function currency_format($number, $suffix = ' VNĐ'){
    return number_format($number).$suffix;
}