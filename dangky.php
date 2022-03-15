<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Trang đăng lý</title>
        <link rel="stylesheet" href="dangky.css"> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    </head>
    <body>
      <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
              <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Đăng ký</h3>
                  <form action='xuly.php' method='POST'>

                    <div class="row">
                      <div class="col-md-6 mb-4">

                        <div class="form-outline">
                          <input type="text" id="firstName" name="txtUsername" class="form-control form-control-lg" />
                          <label class="form-label" for="firstName">Tên đăng nhập</label>
                        </div>

                      </div>
                      <div class="col-md-6 mb-4">

                        <div class="form-outline">
                          <input type="password" id="lastName" name="txtPassword" class="form-control form-control-lg" />
                          <label class="form-label" for="lastName">Mật khẩu</label>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-4 d-flex align-items-center">

                        <div class="form-outline datepicker w-100">
                          <input
                            type="text"
                            class="form-control form-control-lg"
                            name="txtEmail"
                            id="birthdayDate"
                          />
                          <label for="birthdayDate" class="form-label">Email</label>
                        </div> 
                      </div>
                      <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                          <select name="txtSex" id="emailAddress" class="form-control form-control-lg" />
                            <option value=""></option>
                            <option value="Nam">Nam</option>
                            <option value="Nu">Nữ</option>
                          </select>
                          <label class="form-label" for="emailAddress">Giới tính</label>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                          <input type="text" id="emailAddress" name="txtFullname" class="form-control form-control-lg" />
                          <label class="form-label" for="emailAddress">Họ tên</label>
                        </div>

                      </div>
                      <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                          <input type="text" id="phoneNumber" name="txtBirthday" class="form-control form-control-lg" />
                          <label class="form-label" for="phoneNumber">Ngày sinh</label>
                        </div>

                      </div>
                    </div>
                    <div class="mt-4 pt-2">
                      <input class="btn btn-primary btn-lg" type="submit" name="dangky" value="Đăng ký" />
                      <input class="btn btn-primary btn-lg" type="reset" value="Nhập lại" />
                    </div>
                    <br/>
                    <a href="dangnhap.php" style="padding-top: 50px">Đăng nhập</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </body>
</html>