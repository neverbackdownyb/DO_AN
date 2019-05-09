<?php get_header() ;
//show_array($page);
?>
<div id="main-content-wp" class="detail-news-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail clearfix">
                <h3 class="title fl-left">Kiến thức & Mẹo hay</h3>
                <ul class="list-breadcrumb fl-right">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Kiến thức & Mẹo hay</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div id="content" class="fl-left">
            <div class="section" id="detail-news-wp">
                <?php if(!empty($page['title'])) {?>
                <div class="section-detail">
                    <h3 class="title"><?php echo $page['title'] ;?></h3>
                    <span class="create-date"><?php echo $page['created_at'] ;?></span>
                    <div class="detail">
                        <?php echo $page['description'] ;?>
                    </div>
                </div>
                <?php }  else {
                   echo "Bài viết đã bị xóa hoặc không tồn tại. Bấm <a href='?'>vào đây</a> để trở về trang chủ ";
               } ?>
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
<?php get_footer() ?>