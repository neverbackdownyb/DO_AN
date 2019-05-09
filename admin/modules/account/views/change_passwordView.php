<?php get_header() ?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới tài khoản</a>
            <h3 id="index" class="fl-left">Đổi mật khẩu</h3>
        </div>

    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('admin'); ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="">
                        <label for="old_password">Mật khẩu cũ</label>
                        <p class="error"><?php echo form_error('password'); ?></p>
                        <p class="error"><?php echo form_error('old_password'); ?></p>

                        <input type="password" name="old_password" id="pass-old">

                        <label for="new_password">Mật khẩu mới</label>
                        <p class="error"><?php echo form_error('new_password'); ?></p>
                        <p class="error"><?php echo form_error('check_pass'); ?></p>
                        <input type="password" name="new_password" id="pass-new">

                        <label for="repassword" name="repassword">Xác nhận mật khẩu</label>
                        <p class="error"><?php echo form_error('re_password'); ?></p>
                        <input type="password" name="re_password" id="confirm-pass">

                        <button type="submit" name="submit_change_password" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>