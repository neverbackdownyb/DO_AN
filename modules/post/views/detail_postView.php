<?php
get_header();
//echo $get_title_parent;

//show_array($post)
?>
<div id="main-content-wp" class="detail-news-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail clearfix">
                <h3 class="title fl-left">Tin Tức</h3>
                <ul class="list-breadcrumb fl-right">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Tin Tức</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div id="content" class="fl-left">
            <div class="section" id="detail-news-wp">
                <?php if (isset($post['title'])) { ?>
                    <div class="section-detail">
                        <h3 class="title"><?php echo $post['title']; ?></h3>
                        <span class="create-date">  <?php echo $post['created_at']; ?></span>
                        <div class="detail">
                            <?php echo $post['description']; ?>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "Bài viết này không tồn tại hoặc đã bị xóa.Vui lòng bấm <a href='?'>vào đây </a>để quay lại trang chủ !";
                }
                ?>
            </div>
            <div class="section social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="https://facebook.com/1707310909585150/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <?php get_sidebar() ?>
    </div>
</div>
<?php get_footer(); ?>