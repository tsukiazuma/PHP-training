<?php 
if(!empty($_GET['file']))
{
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

 ?>
<html>
    <head>
        <title>Download</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
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
                <img src="https://static2.yan.vn/YanThumbNews/2167221/202005/89a62e26-c68d-4a09-bf7d-bb824c50978b.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                <h4 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2"><a href="trangchu.php" style="padding-top: 25px">Trang chủ</a></h4>
                <div class="card-body p-4 p-md-5">
                  <h3 align="center" class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Download file</h3>
                    <div align="center">
                        <?php
                            require_once('ketnoi.php');

                            $sql = "SELECT * FROM file";
                            $result = execute($sql);
                            $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        ?>
                        <table>
                                <thead>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Filename</th>
                                    <th>Download</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($files as $file) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $file['username']; ?></td>
                                            <td><?php echo $file['file']; ?></td>
                                            <td><a class="btn btn-primary" href="downfile.php?file=<?php echo $file['file'] ?>">Download</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>   
    </body>
</html>