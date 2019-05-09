<?php
get_header();
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=account&controller=index&action=add" title="" id="add-new" class="fl-left">Thêm mới tài khoản</a>
            <h3 id="index" class="fl-left">Danh sách admin</h3>
            <p> <?php echo $message; ?></p>
        </div>


    </div>
    <?php get_sidebar('admin') ?>

    <p class="error"> <?php form_error('role_admin') ?></p>

    <div id="content" class="fl-right"> 
        <div class="section-detail">
            <div class="filter-wp clearfix">
                <ul class="post-status fl-left">
                    <li class="all"><a href="?mod=account&controller=index&action=index">Tất cả <span class="count">(<?php echo get_num_admin_by_status(''); ?>)</span></a> |</li>
                    <li class="publish"><a href="?mod=account&controller=index&action=index&status=active">Đã kích hoạt <span class="count"> (<?php echo get_num_admin_by_status('active'); ?>) </span></a> |</li>
                    <li class="pending"><a href="?mod=account&controller=index&action=index&status=pendy">Chờ kích hoạt <span class="count">(<?php echo get_num_admin_by_status('pendy'); ?>)</span></a> |</li>
                    <li class="pending"><a href="?mod=account&controller=index&action=index&status=bin">Thùng rác <span class="count">(<?php echo get_num_admin_by_status('bin'); ?>)</span></a></li>
                </ul>
                <form method="POST" class="form-s fl-right" action="">
                    <input type="text" name="s" id="s">
                    <input type="submit" name="sm_s" value="Tìm kiếm">
                </form>
            </div>

            <div class="actions">
                <form method="POST" action="?mod=account&controller=index&action=task" class="form-actions">
                    <select name="actions">
                        <option value="">Tác vụ</option>
                        <?php foreach ($option as $k => $v) { ?>
                            <option value="<?php echo $k ?>"> <?php echo $v ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" name="sm_action" value="Áp dụng">
                    </div>
                    <div class="section" id="detail-page">
                        <div class="section-detail">
                            <div class="table-responsive">

                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Họ và tên</span></td>
                                            <td><span class="thead-text">Username</span></td>
                                            <td><span class="thead-text">Email</span></td>
                                            <td><span class="thead-text">Chức vụ</span></td>
                                            <td><span class="thead-text">Trạng Thái</span></td>
                                            <td><span class="thead-text">Thời gian</span></td>
                                            <td><span class="thead-text">Thao tác</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stt = 0;
                                        foreach ($list_admin as $item) {
                                            $stt++;
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="item_check_box[]" class="checkItem" value="<?php echo $item['id']; ?>"></td>
                                                <td><span class="tbody-text"><?php echo $stt ?> </span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <?php echo $item['fullname']; ?>
                                                    </div>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $item['username']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo$item['email']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['role']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo$item['status']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['time'] ?></span></td>
                                                <td>  <ul class="list-operation">
                                                        <li><a href="<?php echo $item['url_update']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="<?php echo $item['url_delete']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>

                                                    </ul>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="section" id="paging-wp">
                        <div class="section-detail clearfix">
                            <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>

                        </div>
                    </div>
            </div>
        </div>
    </div>
    <?php
    get_sidebar()?>