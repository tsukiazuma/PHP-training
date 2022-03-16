<?php
    session_start();
    if (!(isset($_SESSION['username']) && $_SESSION['username'])) {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Vui lòng đăng nhập');window.location.href='dangnhap.php';</script>");
    }
?>
<html>
    <head>
        <title>Upload</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">
              <div class="card rounded-3">
                <img src="https://static2.yan.vn/YanThumbNews/2167221/202005/89a62e26-c68d-4a09-bf7d-bb824c50978b.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                <h4 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2"><a href="trangchu.php" style="padding-top: 25px">Trang chủ</a></h4>
                <div class="card-body p-4 p-md-5">
                  <h3 align="center" class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Upload file</h3>
                    <div align="center">
                        <form method="post" action="xuliup.php" enctype="multipart/form-data">
                            <input type="file" name="upload_file"/>
                            <input type="submit" name="uploadclick" value="Upload"/>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>   
    </body>
</html>