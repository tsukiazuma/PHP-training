<?php
	//Kiểm tra: nếu không phải đăng ký thì không xử lý
	if (!isset($_POST['txtUsername'])) {
		die('');
	}

	//Kết nối với database
	include('DBConnect.php');

	//Khai báo utf-8 để hiển thị tiếng Việt
	header('Content-Type: text/html; charset=UTF-8');

	//Lấy dữ liệu từ form đăng ký
	$username = addslashes($_POST['txtUsername']);
	$password = addslashes($_POST['txtPassword']);
	$email = addslashes($_POST['txtEmail']);
	$fullname = addslashes($_POST['txtFullname']);

	//Kiểm tra người dùng đã nhập đủ thông tin chưa
	if (!$username || !$password || !$email || !$fullname) {
		echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
		exit;
	}

	//Mã hóa mật khẩu bằng MD5
	$password = md5($password);

	// //Kiểm tra tên đăng nhập có tồn tại không
	// $check_user = mysql_query("SELECT username FROM member WHERE username = '".$username."'");
	// if (mysqli_num_rows($check_user) >0) {
	// 	echo "Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
	// }

	// //Kiểm tra email có hợp lệ không
	// if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
	// 	echo "Email không hợp lệ. Vui lòng nhập email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
	// }

	// //Kiểm tra email có tồn tại không
	// $check_email = "SELECT email FROM member WHERE email = '".$email."'";
	// if (mysql_num_rows(mysql_result("SELECT email FROM member WHERE email='$email'")) >0) {
	// 	echo "Email đã tồn tại. Vui lòng chọn email. <a href='javascript: history.go(-1)'>Trở lại</a>";
	// }

	//Lưu thông tin người dùng
	$addmember = mysqli_query("
		INSERT INTO member (
			username,
			password,
			email,
			fullname
		)
		VALUE (
			'{$username}',
			'{$password}',
			'{$email}',
			'{$fullname}'
		)
	");

	//Thông báo quá trình lưu
	if ($addmember) {
		echo "Đăng ký thành công. <a href='/'>Về trang chủ</a>";
	}
	else
		echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='register.php'>Thử lại</a>";
?>