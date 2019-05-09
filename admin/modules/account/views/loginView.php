<html>
    <head>
        <title>Đăng nhập</title>
        <meta charset="utf-8"/>
        <link href="public/css/import/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wp_form_login">
            <h1>FORM ĐĂNG NHẬP</h1>
            <label style="color: red;"> <?php form_error('login');?></label>
            <form id="form_login" action="" method="post">
                <label for="username">Tên đăng nhâp</label>
                <label style="color: red"> <?php form_error('username');?></label>
                <input type="text" name="username" id="username" />
                <label for="password">Mật khẩu</label>
                <label style="color: red"> <?php form_error('password');?></label>
                <input type="password" name="password" id="password" />
                <input type="submit" name="sm_login" value="Đăng nhập"/>
            </form>
        </div>

    </body>
</html>
