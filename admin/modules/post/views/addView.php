<?php get_header();
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_post" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
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
                        <p class="error"><?php form_error('title')?></p>
                        <input type="text" name="title" id="title" value="<?php set_value('title') ?>">
                        
                        <label for="title">Slug ( Friendly_url )</label>
                        <p class="error"><?php form_error('slug')?></p>
                        <input type="text" name="slug" id="slug" value="<?php set_value('slug') ?>" >
                        
                        <label for="excerpt">Mô tả</label>
                        <p class="error"><?php form_error('excerpt')?></p>
                        <textarea name="excerpt" id="excerpt" class="ckeditor"><?php echo set_value('excerpt') ?></textarea>
                        
                        <label for="desc">Chi tiết bài viết</label>
                        <p class="error"><?php form_error('desc')?></p>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo set_value('desc') ?></textarea>
                        
                        <label>Hình ảnh</label>
                        <p class="error"><?php form_error('id_media') ?></p>
                        <div id="result"></div>
                        <div id="uploadFile" class="clearfix">
                            <input type="file" name="file" id="file" data-uri="?mod=media&controller=index&action=upload_single">
                            <input type="hidden" name="id_media" value="<?php set_value('id_media') ?>" id="id_media">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <img src="public/images/img-thumb.png">
                        </div>
                      
                        <label>Danh mục cha</label>
                        <p class="error"><?php form_error('cat_id')?></p>
                        </label>
                         <select name="cat_id">
                            <option value="0">-- Chọn danh mục --</option>
                                
                            <?php 
                            foreach ($list_catagory as $item_select) { ?>
                                
                            <option  <?php selected_form('cat_id', $item_select['id'])?> value="<?php echo $item_select['id'] ?>"> <?php echo str_repeat('----', $item_select['level']) . $item_select['catagory'] ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" name="submit_add" id="btn-submit" value="Thêm mới">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>