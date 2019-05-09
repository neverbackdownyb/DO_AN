<!DOCTYPE html><?php
// $info_admin =  info_admin($id_admin);
//show_array($_SESSION);
$info_admin = info_admin();
?>
<html>
    <head>
        <title><?php echo $title_page;?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>

        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>  
        <script src="plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="?mod=post&controller=post&action=index" title="" id="logo" class="fl-left">TRAIWEB</a>
                        <ul id="main-menu" class="fl-left">
                            <li>
                                <a href="?mod=page&controller=index&action=index" title="">Trang</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=page&controller=index&action=add" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=page&controller=index&action=index" title="">Danh sách trang</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=post&controller=post&action=index" title="">Bài viết</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=post&controller=cat_post&action=addcatagory" title="">Thêm mới danh mục</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=post&controller=post&action=add" title="">Thêm mới bài viết</a> 
                                    </li>

                                    <li>
                                        <a href="?mod=post&controller=post&action=index" title="">Danh sách bài viết</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=post&controller=cat_post&action=catagory" title="">Danh mục bài viết</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=product&controller=product&action=list" title="">Sản phẩm</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=product&controller=cat_product&action=add_catagory" title="">Thêm mới danh mục</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=product&controller=product&action=add_product" title="">Thêm mới sản phầm</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=product&controller=product&action=index" title="">Danh sách sản phẩm</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=product&controller=cat_product&action=list_catagory" title="">Danh mục sản phẩm</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" title="">Bán hàng</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=order&controller=index&action=list" title="">Danh sách đơn hàng</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=order&controller=index&action=list" title="">Danh sách khách hàng</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" title="">Menu</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=menu&controller=index&action=index" title="">Menu</a>
                                 
                                    </li>  
                                    <li>
                                        <a href="?mod=menu&controller=type_menu&action=type_menu" title="">Loại menu</a>
                                    </li>
                                
                                </ul>
                                  
                            </li>

                            <li>
                                <a href="?mod=history&controller=index&action=index" title="">Lịch sử</a>
                            </li>
                        </ul>
                        <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                            <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div  id="thumb-circle" class="fl-left">
                                    <img width="68px" src="<?php echo $info_admin['link']; ?>">
                                </div>
                                <h3 id="account" class="fl-right">
                                    <label><?php echo $info_admin['fullname'] ?> </label>
                                </h3>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="?mod=account&controller=index&action=info_admin" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                <li><a href="?mod=account&controller=index&action=logout" title="Thoát">Thoát</a></li>
                            </ul>
                        </div>
                    </div>
                </div>