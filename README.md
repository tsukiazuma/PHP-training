Người thực hiện: Trần Ngọc Nam
Ngày thực hiện: 14-18/3/2022
# PHP-training
1. [Kết nối database](#1)
2. [Trang đăng nhập/đăng ký có kết nối database](#2)
3. [Chức năng tìm kiếm (username)](#3)
4. [Chức năng download/upload file](#4)
5. [Chức năng cho người khác comment vào Blog (comment vào hình gắn tĩnh trên web)](#5)

## Kết nối Database<a name="1"></a>
- Gồm ketnoi.php và define.php
- Define.php khai báo các host, database, username, password
- Ketnoi.php gồm các hàm thực thi sql
    ```php
        function executeResult($sql){
                // Mở kết nối
                $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);
                mysqli_set_charset($conn,'utf8');
                // Truy vấn
                $resultset = mysqli_query($conn,$sql);      
                mysqli_close($conn);
                return $resultset;
            }
    ```
- Hàm mysqli_connect tạo kết nối tới database thông qua các tham số HOST, USERNAME, PASSWORDm DATABASE.
- Hàm mysqli_set_charset với tham số utf8 để chọn bảng mã tiếng việt là mặc định.
- Hàm mysqli_query  thực hiện truy vấn và trả về đối tượng kết quả sql

## Đăng nhập/Đăng ký<a name="2"></a>
- Đăng ký gồm dangky.php - form để đăng ký và xyly.php để xử lý đăng ký member

```php
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
    if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $email))
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
```
- Hàm addslashes chèn kí tự \\ vào kí tự hoặc chuỗi kí tự để trách sql injection
    Ví dụ:
	```php
	echo addslashes('Các bạn đang đọc bài tại "freetuts", chúc các bạn học PHP tốt');
	echo addslashes("Các bạn đang đọc bài tại 'freetuts', chúc các bạn học PHP tốt");
	```
    Kết quả trả về:
    ```php
	Các bạn đang đọc bài tại \"freetuts\", chúc các bạn học PHP tốt
	Các bạn đang đọc bài tại \'freetuts\', chúc các bạn học PHP tốt
    ```

- Hàm mysqli_num_rows trả về số hàng trong tập hợp kết quả truyền vào.
- Hàm preg_match kiểm tra so sánh với pattern là /(0[1-9]|1[0-9]|2[0-9]|3[01])[\/-](0[1-9]|1[0-2])[\/-](19[5-9][0-9]|20[0-9][0-9])/ và subject là $email rồi trả về kết quả.

- Đăng nhập gồm dangnhap.php bao gồm form lẫn xử lý đăng nhập
```php
	//Khởi tạo session
	session_start();

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
    if (mysqli_num_rows($userExist) == 0){
        echo ("<script LANGUAGE='JavaScript'>window.alert('Đăng nhập không thành công. Vui lòng kiểm tra lại.');window.location.href='dangnhap.php';</script>");
        exit;
    }
```
- Hàm session_start để bắt đầu một session.

## Tìm kiếm<a name="3"></a>
- Timkiem.php gồm form lẫn xử lý tìm kiếm bằng username
```php
	// Phải đăng nhập để tìm kiếm
	session_start();
    if (!(isset($_SESSION['username']) && $_SESSION['username'])) {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Vui lòng đăng nhập');window.location.href='dangnhap.php';</script>");
    }

    if (empty($search)) {
        echo "Yeu cau nhap du lieu vao o trong";
    } 
    else
        {
        // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
        $query = "select * from member where username like '%$search%'";
        // Kết nối sql
        require_once('ketnoi.php');
        // Thực thi câu truy vấn
        $sql = executeResult($query);
        // Đếm số đong trả về trong sql.
        $num = mysqli_num_rows($sql);
        // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
        if ($num > 0 && $search != "") 
        {
            // Dùng $num để đếm số dòng trả về.
            echo "$num ket qua tra ve voi tu khoa <b>$search</b>";
            // Vòng lặp while & mysql_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
            echo '<table border="1" cellspacing="0" cellpadding="10">';
            while ($row = mysqli_fetch_assoc($sql)) {
                echo '<tr>';
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['password']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['fullname']}</td>";
                echo "<td>{$row['birthday']}</td>";
                echo "<td>{$row['sex']}</td>";
                echo '</tr>';
            }
            echo '</table>';
        } 
        else {
            echo "Khong tim thay ket qua!";
        }
    }
```
- Hàm mysqli_fetch_assoc sẽ tìm và trả về kết quả theo hàng dưới dạng một mảng kết hợp.

## Upload/Dowload file<a name="4"></a>
- Upload gồm upfile.php chứa form và xuliup.php để xử lý up file
```php
	// Yêu cầu đăng nhập để up file
	session_start();
    if (!(isset($_SESSION['username']) && $_SESSION['username'])) {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Vui lòng đăng nhập');window.location.href='dangnhap.php';</script>");
    }

    // Tạo đường dẫn để up file
    $folder_path = 'upload/';
    $file_path = $folder_path.$_FILES['upload_file']['name'];
    $flag = true;
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["upload_file"]["tmp_name"]);
        if($check !== false){
            echo "File là một ảnh - " .$check["mime"] . ".";
            $flag = true;
        }
        else{
            echo "File không là ảnh.";
            $flag = false;
        }
    }

    // Check file trùng
    if(file_exists($file_path)){
        echo ("<script LANGUAGE='JavaScript'>window.alert('File đã tồn tại.');window.location.href='upfile.php';</script>");
        $flag = false;
    }

    //Check đuôi
    $ex = array('jpg', 'png', 'jpeg');
    $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    if(!in_array($file_type,$ex)){
        echo ("<script LANGUAGE='JavaScript'>window.alert('File không hợp lệ');window.location.href='upfile.php';</script>");
        $flag = false;
    }

    // Check độ lớn
    if($_FILES['upload_file']['size'] > 5242880){
        echo ("<script LANGUAGE='JavaScript'>window.alert('File không được quá 5MB');window.location.href='upfile.php';</script>");
        $flag = false;
    }

    // Upload
    if($flag){
        move_uploaded_file($_FILES['upload_file']['tmp_name'], $file_path); //tên tệp của tệp đã tải lên, vị trí mới cho tệp
        require_once('ketnoi.php');
        $username = $_SESSION['username'];
        $file = $_FILES['upload_file']['name'];
        $sql = "INSERT INTO file (username, file) VALUE('{$username}', '{$file}')";
        executeResult($sql);
        echo ("<script LANGUAGE='JavaScript'>window.alert('Upload thành công');window.location.href='upfile.php';</script>");
    }
    else{
        echo ' - Upload thất bại';
    }
```
- Hàm getimagesize trả về một phần tử mảng với chiều cao, chiều rộng, loại, loại MIME(dạng img/png) của hình ảnh,...
  Ví dụ:
    ```php
    getimagesize(file_name, img_info)

    Với:
    file_name: Hình ảnh tệp tức là đường dẫn hình ảnh.
    img_info: Trích xuất một số thông tin mở rộng từ tệp hình ảnh. Chỉ hỗ trợ các tệp JFIF.
    ```
- Hàm pathinfo trả về thông tin về đường dẫn tệp.
  Ví dụ:
  ```php
    pathinfo(path, options)

    Với:
    path: đường dẫn cần lấy thông tin.
    options: chỉ định phần tử được trả về (có thể có hoặc không)
        PATHINFO_DIRNAME - chỉ trả lại tên dirname
        PATHINFO_BASENAME - chỉ trả lại tên cơ sở
        PATHINFO_EXTENSION - chỉ trả lại phần mở rộng
        PATHINFO_FILENAME - chỉ trả lại tên tệp
    ```
- Hàm move_uploaded_file di chuyển tệp đã tải lên đến đích mới.

- Downfile.php chứa form lẫn xử lý download
```php
	// Yêu cầu đăng nhập để download
	session_start();
    if (!(isset($_SESSION['username']) && $_SESSION['username'])) {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Vui lòng đăng nhập');window.location.href='dangnhap.php';</script>");
    }

    // Xử lý upload
    if(!empty($_GET['file'])) {
        $filename = basename($_GET['file']);
        $filepath = 'upload/' . $filename;
        if(!empty($filename) && file_exists($filepath)){
			//Define Headers
            header("Cache-Control: public");
            header("Content-Description: FIle Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/zip");
            header("Content-Transfer-Emcoding: binary");
			readfile($filepath);
            exit;
		}
        else{
           	echo "This File Does not exist.";
        }
    }

    // Load file từ forder upload file lúc nãy
	$sql = "SELECT * FROM file";
    $result = executeResult($sql);
    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Xuất ra màn hình các file đã load đc
    <?php $i = 1;
    foreach ($files as $file) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $file['username']; ?></td>
            <td><?php echo $file['file']; ?></td>
            <td><a class="btn btn-primary" href="downfile.php?file=<?php echo $file['file'] ?>">Download</a></td>
        </tr>
    <?php endforeach; ?>
```
- Hàm basename trả về tên tệp từ đường dẫn.
- Hàm mysqli_fetch_all tìm và trả về tất cả các kết quả dưới dạng một mảng kết hợp.

## Comment vào blog có sẵn<a name="5"></a>
- Binhluan.php bao gồm form lẫn xử lý
```php
	// Yêu cầu đăng nhập để comment
	session_start();
    if (!(isset($_SESSION['username']) && $_SESSION['username'])) {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Vui lòng đăng nhập');window.location.href='dangnhap.php';</script>");
    }

    // Xử lý và load các bình luận của blog
    $sql = "SELECT * FROM comment";
    $result = executeResult($sql);
    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);

    <?php $i = 1;
    foreach ($files as $file) : ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $file['username']; ?></td>
        <td><?php echo $file['date']; ?></td>
        <td><?php echo $file['message']; ?></td>
    </tr>
    <?php endforeach; ?>
```