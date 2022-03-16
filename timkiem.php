<?php
    session_start();
    if (!(isset($_SESSION['username']) && $_SESSION['username'])) {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Vui lòng đăng nhập');window.location.href='dangnhap.php';</script>");
    }
?>
<html>
    <head>
        <title>Tìm kiếm</title>
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
                  <h3 align="center" class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Tìm kiếm Username</h3>
                      <div align="center">
                        <form action="timkiem.php" method="get">
                            Tìm kiếm: <input type="text" name="timkiem" />
                            <input type="submit" name="ok" value="Tìm kiếm" />
                        </form>
                        </div>
                        <?php
                        if (isset($_REQUEST['ok'])) 
                        {
                            // Gán hàm addslashes để chống sql injection
                            $search = addslashes($_GET['timkiem']);
                 
                            // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
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
                                $sql = execute($query);
                 
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
                        }
                        ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>   
    </body>
</html>