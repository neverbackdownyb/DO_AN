<?php get_header();
//$side_bar = get_list_menu('Sidebar_post');
//echo $side_bar;

//get_side_bar_post()
//echo 

?>

<div id="main-content-wp" class="category-news-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail clearfix">
                <h3 class="title fl-left"><?php echo $title_catagory ?></h3>
                <ul class="list-breadcrumb fl-right">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $title_catagory ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">

        <div id="content" class="fl-left">   <?php
            if (!empty($list_post)) {
                foreach ($list_post as $post) {
                    ?>
                    <div class="section" id="list-news-wp">
                        <div class="section-detail">

                            <ul class="list-item">
                                <li class="clearfix">
                                    <a href="<?php echo $post['detail_post'] ?>" title="" class="thumb fl-left">
                                        <img src="<?php echo $post['link'] ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="<?php echo $post['detail_post'] ?>" title="" class="title"><?php echo $post['title'] ?></a>
                                        <span class="create-date"><?php echo $post['created_at'] ?></span>
                                        <p class="desc"><?php echo $post['excerpt'] ?></p>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                <?php }
                ?>
                <div class="section" id="pagination-wp">
                    <div class="wp-inner">
                        <div class="pagination">
                            <strong>1</strong>
                            <a href="" title="">2</a>
                            <a href="" title>3</a>
                            <a href="">&gt;</a>                    
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo " Không có bài viết nào thuộc danh mục này. Bấm <a href='?mod=home&controller=index&action=index'> vào đây </a> để quay lại trang chủ";
            }
            ?>
        </div>
        <?php get_sidebar() ?>
    </div>
</div>
<?php get_footer() ?>