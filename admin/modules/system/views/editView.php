<?php
get_header();
// show_array($slider);
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_post" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Chỉnh sửa cấu hình hệ thống</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <!--<form method="POST" action=""  enctype="multipart/form-data" id="form-upload-single">-->
                    <form method="POST" action="" id="form-upload-single">
                        <label for="title">Tên website</label>
                        <p class='error'><?php form_error("title"); ?></p>
                        <input type="text" name="title" id="title" value="<?php echo $system['title'] ;?>">
                        <label for="email">Email</label>
                        <p class='error'><?php form_error("email"); ?></p>
                        <input type="text" name="email" id="email" value=<?php echo $system['email'] ;?>">

                        <label for="phone">Điện thoại</label>
                        <p class='error'><?php form_error("phone"); ?></p>
                        <input type="text" name="phone" id="phone" value="<?php echo $system['phone'] ;?>">

                        <label for="bank_account">Tài khoản ngân hàng</label>
                        <p class='error'><?php form_error("bank_account"); ?></p>
                        <div class="clearfix" style="padding-bottom:12px;">
                            <input type="text" name="bank_name" id="bank_name" value="<?php echo $system['bank_name'] ;?>" placeholder="Tên ngân hàng ...">
                            <input type="text" name="account_number" id="account_number" value="<?php echo $system['account_number'] ;?>" placeholder="Số tài khoản ...">
                            <input style="padding: 0px 10px; font-size: 12px" type="submit" name="add_bank_account" id="add_bank_account" value="Thêm">
                        </div>

                        <label for="fanpage">Fanpage</label>
                        <p class='error'><?php form_error("fanpage"); ?></p>
                        <input type="text" name="fanpage" id="fanpage" value="<?php echo $system['fanpage'] ;?>">

                        <label for="google">Google+</label>
                        <p class='error'><?php form_error("google"); ?></p>
                        <input type="text" name="google" id="google" value="<?php echo $system['google'] ;?>">

                        <label for="address">Địa chỉ</label>
                        <p class='error'><?php form_error("address"); ?></p>
                        <input type="text" name="address" id="address" value="<?php echo $system['address'] ;?>">

                        <label for="meta_key">Meta key</label>
                        <p class='error'><?php form_error("meta_key"); ?></p>
                        <textarea name="meta_key" id="meta_key" class="ckeditor"><?php echo $system['meta_key'] ;?></textarea>

                        <label for="meta_description">Meta description</label>
                        <p class='error'><?php form_error("meta_description"); ?></p>
                        <textarea name="meta_description" id="meta_description" class="ckeditor"><?php echo $system['meta_description'] ;?></textarea>

                        <label>Logo</label>
                        <p class="error"><?php form_error('id_media') ?></p>
                        <div id="result"></div>
                        <div id="uploadFile" class="clearfix">
                            <input type="file" name="file" id="file" data-uri="?mod=media&controller=index&action=upload_single">
                            <input type="hidden" name="id_media" value="<?php echo $system['id_media'] ;?>" id="id_media">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <img src="<?php echo $system['link']; ?>">
                        </div>
                        <button type="submit" name="submit_add" id="btn-submit" value="Thêm mới">Cập nhật </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>