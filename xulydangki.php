<?php
 
    // Nếu không phải là sự kiện đăng ký thì không xử lý
    if (!isset($_POST['txtUsername'])){
        die('');
    }
     
    //Nhúng file kết nối với database
    require_once('ketnoi.php');
          
    //Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
          
    //Lấy dữ liệu từ file dangky.php
    $username   = addslashes($_POST['txtUsername']);
    $password   = addslashes($_POST['txtPassword']);
    $email      = addslashes($_POST['txtEmail']);
    $fullname   = addslashes($_POST['txtFullname']);
    $birthday   = addslashes($_POST['txtBirthday']);
    $sex        = addslashes($_POST['txtSex']);
          
    //Kiểm tra người dùng đã nhập liệu đầy đủ chưa
    if (!$username || !$password || !$email || !$fullname || !$birthday || !$sex)
    {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Vui lòng nhập đầy đủ thông tin.');window.location.href='dangky.php';</script>");
        exit;
    }
          
    // Mã khóa mật khẩu
    $password = md5($password);

    //Kiểm tra tên đăng nhập này đã có người dùng chưa
    $sql = "SELECT username FROM member WHERE username='$username'";
    $userExist = executeResult($sql);
    if (mysqli_num_rows($userExist) > 0){
        echo ("<script LANGUAGE='JavaScript'>window.alert('Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. ');window.location.href='dangky.php';</script>");
        exit;
    }
          
    //Kiểm tra email có đúng định dạng hay không
    if (!preg_match ("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $email))
    {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Email này không hợp lệ. Vui long nhập email khác.');window.location.href='dangky.php';</script>");
        exit;
    }

    //Kiểm tra email đã có người dùng chưa
    $sql = "SELECT email FROM member WHERE email='$email'";
    $emailExist = executeResult($sql);
    if (mysqli_num_rows($emailExist) > 0)
    {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Email này đã có người dùng. Vui lòng chọn Email khác.');window.location.href='dangky.php';</script>");
        exit;
    }
    
    //Kiểm tra dạng nhập vào của ngày sinh
    if (!preg_match("/(0[1-9]|1[0-9]|2[0-9]|3[01])[\/-](0[1-9]|1[0-2])[\/-](19[5-9][0-9]|20[0-9][0-9])/", $birthday))
    {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Ngày tháng năm sinh không hợp lệ. Vui long nhập lại.');window.location.href='dangky.php';</script>");
        exit;
    }
          
    //Lưu thông tin thành viên vào bảng
    $addmember = executeResult("INSERT INTO member (username, password, email, fullname, birthday, sex) VALUE ('{$username}', '{$password}', '{$email}', '{$fullname}', '{$birthday}', '{$sex}')");
                          
    //Thông báo quá trình lưu
    if ($addmember)
        echo ("<script LANGUAGE='JavaScript'>window.alert('Quá trình đăng ký thành công.');window.location.href='dangnhap.php';</script>");
    else
        echo ("<script LANGUAGE='JavaScript'>window.alert('Có lỗi xảy ra trong quá trình đăng ký.');window.location.href='dangky.php';</script>");
?>