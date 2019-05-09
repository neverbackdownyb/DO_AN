<?php get_header();

?>

<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=account&controller=index&action=add" title="" id="add-new" class="fl-left">Thêm mới tài khoản</a>
            <h3 id="index" class="fl-left">Thông tin tài khoản</h3>
        </div>
    </div>
  <?php    get_sidebar('admin');?>
    
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" id="form-upload-single">
                        <label for="display-name">Tên hiển thị</label>
                        <p class="error"><?php form_error('fullname');?></p>
                        <input type="text" name="fullname" value="<?php echo $user['fullname']?>">
                        
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="<?php echo $user['username']?>" readonly="readonly">
                        
                        <label for="email">Email</label>
                         <p class="error"><?php form_error('email');?></p>
                         <input type="email" name="email" id="email" value="<?php echo $user['email']?>">
                         
                        <label for="tel">Số điện thoại</label>
                         <p class="error"><?php form_error('tel');?></p>
                        <input type="tel" name="tel" id="tel" value="<?php echo $user['phone']?>">
                        
                        <label for="address">Địa chỉ</label>
                         <p class="error"><?php form_error('address');?></p>
                        <textarea name="address" id="address"> <?php echo $user['address']?></textarea>
                        
                         <label>Ảnh đại diện </label>
                        <p class="error"><?php form_error('id_media'); ?></p>
                      <div id="result"></div>
                        <div id="uploadFile" class="clearfix">
                            <input type="file" name="file" id="file" data-uri="?mod=media&controller=index&action=upload_single">
                            <input type="hidden" name="id_media" value="<?php echo $user['id_media']; ?>" id="id_media">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <img src="<?php echo $user['link'] ?>">
                        </div>
                        
                        <button type="submit" name="submit_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>