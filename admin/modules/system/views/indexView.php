<?php
get_header();
//show_array($list_system)
?>

<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách slider</h3>
            <h5 id="index" ><?php echo $message ?></h5>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>

                                    <td><span class="thead-text">Tên website</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Liên Hệ</span></td>
                                    <td><span class="thead-text">Tên NH</span></td>
                                    <td><span class="thead-text">Số TK</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Fanpage</span></td>
                                    <td><span class="thead-text">Google+</span></td>
                                    <td><span class="thead-text">Chỉnh sửa</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_system as $item) { ?>
                                    <tr>
                                        <td><span class="tbody-text"><?php echo $item['title']; ?></span>
                                        <td><span class="tbody-text"><?php echo $item['email']; ?></span>
                                        <td><span class="tbody-text"><?php echo $item['phone']; ?></span>
                                        <td><span class="tbody-text"><?php echo $item['bank_name']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['account_number']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['address']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['fanpage']; ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['google']; ?></span></td>
                                        <td><span class="tbody-text"><a href="<?php echo $item['url_edit']; ?>">Chỉnh sửa</a></span></td>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>