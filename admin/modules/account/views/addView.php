<?php get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Đăng ký tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
     <?php get_sidebar('admin');?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" id="form-upload-single">
                        <label for="display-name">Họ và tên</label>
                        <p class="error"><?php form_error('fullname'); ?></p>  
                        <input type="text" name="fullname"  value="<?php set_value('fullname'); ?>">

                        <label for="username" >Tên đăng nhập</label>
                        <p class="error"><?php form_error('username'); ?></p>
                        <p class="error"><?php form_error('ex_username'); ?></p>
                        <input type="text" name="username" value="<?php set_value('username'); ?>">

                        <label for="email">Email</label>
                        <p class="error"> <?php form_error('email'); ?></p>
                        <p class="error"> <?php form_error('ex_email'); ?></p>
                        <input type="email" name="email" id="email" value="<?php set_value('email'); ?>">
                        
                        <label for="password">Mật khẩu</label>
                        <p class="error"><?php form_error('password'); ?></p>
                        <input type="password" name="password" id="password">

                        <label for="repassword">Nhập lại mật khẩu</label>
                        <p class="error"><?php form_error('repassword'); ?></p>
                        <input type="password" name="repassword" id="repassword">

                        <label for="tel">Số điện thoại</label>
                        <p class="error"><?php form_error('tel'); ?></p>
                        <p class="error"><?php form_error('ex_phone'); ?></p>
                        <input type="tel" name="tel" id="tel" value="<?php set_value('tel'); ?>">
                        
                        <label for="address">Địa chỉ</label>
                        <p class="error"> <?php form_error('address'); ?></p>
                        <textarea name="address" id="address" ><?php if(isset( $_POST['address'])) {echo $_POST['address'];}?></textarea>
                        
                        <label>Ảnh đại diện </label>
                        <p class="error"><?php form_error('id_media'); ?></p>
                      <div id="result"></div>
                        <div id="uploadFile" class="clearfix">
                            <input type="file" name="file" id="file" data-uri="?mod=media&controller=index&action=upload_single">
                            <input type="hidden" name="id_media" value="<?php set_value('id_media') ?>" id="id_media">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <img src="public/images/img-thumb.png">
                        </div>
                      
                         <label>Trạng thái</label>
                          <p class="error"> <?php form_error('role'); ?></p>
                        <select name="role">
                            <option value="0">-- Chọn quyền --</option>
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>
                        <button type="submit" name="submit_add" id="btn-submit">ĐĂNG KÝ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>