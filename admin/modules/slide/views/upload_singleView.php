
<html>
    <head>
        <title>Upload file Ajax</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="js/customs.js" type="text/javascript"></script>
        <meta charset="utf-8">
    </head>
    <body>
        <style>
            #show_list_file { width:  200px; height: 200px; overflow: hidden;}
            #show_list_file img { max-width: 100%; max-height: 100%;}
        </style>
        <form id="form-upload-single"  action="" enctype="multipart/form-data" method="post">
            <div class="form_group clearfix">
                <label for="detail">Hình ảnh</label><br/><br/>
                <input type="file" name="file" id="file" data-uri="upload_single.php"><br/><br/>
                <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
            </div>
        </form>
        <div id="show_list_file" >
            
        </div>
    </body>
</html>