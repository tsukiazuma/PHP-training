<?php
    session_start();
    if (!(isset($_SESSION['username']) && $_SESSION['username'])) {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Vui lòng đăng nhập');window.location.href='dangnhap.php';</script>");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bình Luận</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
          textarea {
            width: 500px;
            height: 80px;
            background-color: #fff;
            resize: none;
          }
          input {
            margin-top: 10px;
            width: 100px;
            height: 30px;
            background-color: #282828;
            border: none;
            color: #fff;
            font-family: arial;
            font-weight: 400;
            cursor: pointer;
          }
          table {
            width: 60%;
            border-collapse: collapse;
            margin: 100px auto;
        }

        th,
        td {
            height: 50px;
            vertical-align: center;
            border: 1px solid black;
        }
        </style>
    </head>
    <body>
      <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">
              <div class="card rounded-3">
                <div class="card-body p-4 p-md-5">
                  <h4 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2"><a href="trangchu.php" style="padding-top: 25px">Trang chủ</a></h4>
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Cho biết cảm nghĩ của bạn về bức ảnh bên dưới :)))</h3>
                    <img src="https://c.wallhere.com/photos/f0/12/anime_anime_girls_bikini_cleavage_open_shirt_sweater_underboob_long_hair-269371.jpg!d" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                    <div class="comment-form-container">
                      <form id="frm-comment" action='binhluan.php' method='POST'>
                        <?php
                            require_once('ketnoi.php');

                            $sql = "SELECT * FROM comment";
                            $result = execute($sql);
                            $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        ?>
                        <table>
                                <thead>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Date</th>
                                    <th>Commet</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($files as $file) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $file['username']; ?></td>
                                            <td><?php echo $file['date']; ?></td>
                                            <td><?php echo $file['message']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                        </table>
                          <div class="input-row">
                              <textarea type="text" name="comment" placeholder="Bình luận"></textarea>
                          </div>
                          <div>
                              <input type="submit" class="btn-submit" name="binhluan" id="submitButton"
                                  value="Bình luận" />
                          </div>
                      </form>
                      <?php
                      if (isset($_POST['binhluan'])) {
                        require_once ("ketnoi.php");
                        $username = $_SESSION['username'];
                        $comment = addslashes($_POST['comment']);
                        if (!$comment) {
                          echo "Bạn chưa bình luận";
                          exit;
                        }
                        $sql = "INSERT INTO comment(username, message) VALUES ('" . $username . "','" . $comment . "')";
                        $result = execute($sql);
                        echo ("<script LANGUAGE='JavaScript'>;window.location.href='binhluan.php';</script>");
                        if (! $result) {
                          $result = mysqli_error($conn);
                      }
                    }
                    ?>
                  </div>
                  <div id="output"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </body>
</html>