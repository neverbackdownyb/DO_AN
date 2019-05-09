<!DOCTYPE html>
<?php
//show_array($data);
//                        $list =  get_list_menu('header');
//                        show_array($list);exit
//show_array($list_menu);exit;
?>
<html>
    <head>
        <title><?php get_title_page() ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" rel="shortcut icon" href="public/images/favicon.ico"/>
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>

        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/elevatezoom-master/jquery.elevateZoom-3.0.8.min.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="?page=home" title="" id="logo" class="fl-left">
                            <img src="public/images/logo.png" alt="">
                        </a>
                        <?php
                        echo get_menu_header();
                        ?>
                        <div id="action-wp" class="fl-right">
                            <div id="search-wp" class="fl-left">
                                <button type="button" class="btn" data-toggle="modal" data-target="#form-search-wp">
                                    <i class="fa fa-search"></i>
                                </button>
                                <div class="modal fade" id="form-search-wp" tabindex="-1" role="dialog" aria-labelledby="lable">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <h1 class="title">Nhập từ khóa:</h1>
                                           <form id="form-s" action="?mod=home&controller=index&action=search" method="GET">
                                                <input type="hidden" name="mod" value="home" />
                                                <input type="hidden" name="controller" value="index" />
                                                <input type="hidden" name="action" value="search" />
                                                <input type="text" name="name_search" id="s">
                                                <button type="submit" id="btn-s"><i class="fa fa-search"></i></button>
                                            </form>
                                            <div class="thumb">
                                                <img src="public/images/bg-s.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <div id="cart-wp" class="fl-right">
                                <a href="?mod=cart&controller=index&action=show_cart" title="" id="btn-cart">
                                    <?php if (isset($_SESSION['cart']['info']['qty']) && $_SESSION['cart']['info']['qty'] >0 ) { ?>
                                        <i class="fa fa-shopping-basket"></i>
                                        <span id="num"><?php echo $_SESSION['cart']['info']['qty'] ?></span>
                                    <?php
                                    } else { ?>
                                        <i class = "fa fa-shopping-cart" ></i>
                                   <?php  } ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>