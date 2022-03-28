<?php
//Khai báo sử dụng session
session_start();

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) {
  //Kết nối tới database
  require_once('ketnoi.php');

  //Lấy dữ liệu nhập vào
  $username = addslashes($_POST['txtUsername']);
  $password = addslashes($_POST['txtPassword']);

  //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
  if (!$username || !$password) {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.');window.location.href='dangnhap.php';</script>");
    exit;
  }

  // mã hóa pasword
  $password = md5($password);

  //Kiểm tra tài khoản có tồn tại không
  $sql = "SELECT username FROM member WHERE username='$username' and password='$password'";
  $userExist = executeResult($sql);
  if (mysqli_num_rows($userExist) == 0) {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Đăng nhập không thành công. Vui lòng kiểm tra lại.');window.location.href='dangnhap.php';</script>");
    exit;
  }

  $_SESSION['username'] = $username;
  header('location: trangchu.php');
  die();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Trang đăng nhập</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-5">Đăng nhập</h3>

              <form action='dangnhap.php' method='POST'>
                <div class="form-outline mb-4">
                  <input type="text" id="typeEmailX-2" name="txtUsername" class="form-control form-control-lg" />
                  <label class="form-label" for="typeEmailX-2">Tên đăng nhập</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="typePasswordX-2" name="txtPassword" class="form-control form-control-lg" />
                  <label class="form-label" for="typePasswordX-2">Mật khẩu</label>
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-start mb-4">
                  <a href='dangky.php' title='Đăng ký'>Đăng ký</a>
                </div>
                <button class="btn btn-primary btn-lg btn-block" name="dangnhap" type="submit">Đăng nhập</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>