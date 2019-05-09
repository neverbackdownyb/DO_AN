<?php get_header();
// show_array($post)
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_post" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Chỉnh sửa trang </h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <!--<form method="POST" action=""  enctype="multipart/form-data" id="form-upload-single">-->
                    <form method="POST" action="" id="form-upload-single">
                        <label for="title" >Tiêu đề</label>
                        <p class="error"><?php form_error('title');?></p>
                        <input type="text" name="title" id="title" value="<?php echo $post['title'];?>">
                        
                        <label for="title">Slug ( Friendly_url )</label>
                        <p class="error"><?php form_error('slug');?></p>
                        <input type="text" name="slug" id="slug" value="<?php echo $post['slug'] ?>">
                        
                        <label for="desc">Mô tả</label>
                        <p class="error"><?php form_error('desc');?></p>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo $post['description']?></textarea>
                        
                        <label>Hình ảnh</label>
                          <p class="error"><?php form_error('id_media')?></p>
                      <div id="result"></div>
                        <div id="uploadFile" class="clearfix">
                            <input type="file" name="file" id="file" data-uri="?mod=media&controller=index&action=upload_single">
                            <input type="hidden" name="id_media" value="<?php echo $post['id_media'] ;?>" id="id_media">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <img src="<?php echo $post['link'] ;?>">
                        </div>
                  
                        <button type="submit" name="submit_add" id="btn-submit" value="Cập nhật">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>