<?php
    session_start();
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
        move_uploaded_file($_FILES['upload_file']['tmp_name'], $file_path);
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
?>