<?php
get_header();
// show_array($slider);
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_post" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Chỉnh sửa Slider</h3>
        </div>
    </div>
    <div class="wrap clearfix">
<?php get_sidebar() ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <!--<form method="POST" action=""  enctype="multipart/form-data" id="form-upload-single">-->
                    <form method="POST" action="" id="form-upload-single">
                        <label for="title">Tiêu đề</label>
                        <p class="error"><?php form_error('title') ?></p>
                        <input type="text" name="title" id="title" value="<?php echo $slider['capture']; ?>">

                        <label for="excerpt">Mô tả ngắn</label>
                        <p class="error"><?php form_error('excerpt') ?></p>
                        <textarea name="excerpt" id="excerpt" class="ckeditor"><?php echo $slider['excerpt']; ?></textarea>

                        <label>Hình ảnh</label>
                        <p class="error"><?php form_error('id_media') ?></p>
                        <div id="result"></div>
                        <div id="uploadFile" class="clearfix">
                            <input type="file" name="file" id="file" data-uri="?mod=media&controller=index&action=upload_single">
                            <input type="hidden" name="id_media" value="<?php echo $slider['id_media'] ?>" id="id_media">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <img src="<?php echo $slider['link'] ;?>">
                        </div>
                        
                         <label for="title">Thứ tự</label>
                        <p class="error"><?php form_error('order_number') ?></p>
                        <input type="text" name="order_number" id="order_number" value="<?php echo $slider['order_number'] ?>">

                        <label> Trạng Thái</label>
                        <p class="error"><?php form_error('status') ?></p>
                        <select name ="status">
                            <option value="">Trạng thái</option>
                            <option <?php selected($slider['status'], 'pendy')?> value="pendy">Chờ duyệt</option>
                            <option <?php selected($slider['status'], 'active')?> value="active">Đã Đăng</option>
                            <option <?php selected($slider['status'], 'bin')?> value="bin">Thùng rác</option>
                        </select>
                        <button type="submit" name="submit_add" id="btn-submit" value="Thêm mới">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>