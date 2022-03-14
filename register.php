<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" http-equiv="Content-Type" content="text/html;">
	<title>Trang đăng ký</title>
</head>
<body>
	<h1>Trang đăng ký thành viên</h1>
	<form action="process.php" method="POST">
		<table cellpadding="0" cellspacing="0" border="1">
			<tr>
				<td>
					Tên đăng nhập:
				</td>
				<td>
					<input type="text" name="txtUsername" size="50">
				</td>
			</tr>
			<tr>
				<td>
					Mật khẩu:
				</td>
				<td>
					<input type="password" name="txtPassword" size="50">
				</td>
			</tr>
			<tr>
				<td>
					Email:
				</td>
				<td>
					<input type="text" name="txtEmail" size="50">
				</td>
			</tr>
			<tr>
				<td>
					Họ và tên:
				</td>
				<td>
					<input type="text" name="txtFullname" size="50">
				</td>
			</tr>
		</table>
		<input type="submit" name="Đăng ký">
		<input type="reset" name="Nhập lại">
	</form>
</body>
</html>