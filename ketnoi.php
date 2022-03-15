<?php
    require_once('define.php');
    
    // Kết nối database
    $conn = mysqli_connect(HOST,USERNAME, PASSWORD,DATABASE);

    // Thêm, sửa, xóa
    function execute($sql){
        // Truy vấn
        mysqli_query($conn,$sql);
        // Đóng kết nối
        mysqli_close($conn);
    }

    // Truy vấn lay du lieu ra
    function executeResult($sql){
        $data = null;

        // Mở kết nối
        $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn,'utf8');

        // Truy vấn
        $resultset = mysqli_query($conn,$sql);
        
        mysqli_close($conn);
        return $resultset;
    }
?>