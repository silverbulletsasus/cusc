<?php
	include("database.php");
	/*require("public/PHPMailer-master/class.phpmailer.php");*/
	require("public/PHPMailer-master/PHPMailerAutoload.php");

	class M_user extends database
	{
		function dangky($username, $pass, $name, $email, $diachi, $dienthoai, $gioitinh, $ngaysinh, $randomcode)
		{
			$sql = "INSERT INTO khachhang(kh_tendangnhap, kh_matkhau, kh_ten, kh_email, kh_diachi, kh_dienthoai, kh_gioitinh, kh_ngaysinh) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$this->setQuery($sql);
			// có thể dùng md5 nhiều lần hoặc nối với 1 chuỗi nào đó để tăng độ khó
			$result = $this->execute(array($username, md5($pass), $name, $email, $diachi, $dienthoai, $gioitinh, $ngaysinh, $randomcode, 0, 0));
			if($result)
			{
				/*return $this->getLastId();*/
				// hoặc return true
				return true;
			}
			else false;
		}
		function dangnhap($username, $md5_password)
		{
			$sql = "SELECT * FROM khachhang WHERE kh_tendangnhap = '$username' AND kh_matkhau = '$md5_password' AND kh_trangthai = 1";
			$this->setQuery($sql);
			return $this->loadRow(array($username, $md5_password));
		}

		// kiểm tra tên tài khoản và ma kich hoat có tồn tại trước khi đăng kí
		function kiemtratontai($username, $makichhoat)
		{
			$sql = "SELECT * FROM khachhang WHERE kh_tendangnhap = '$username' OR kh_makichhoat = '$makichhoat'";
			$this->setQuery($sql);
			return $this->loadRow(array($username, $makichhoat));
		}

		// update kh_kichhoat = 1 sau khi khach hang da nhap vao link kich hoat
		function updatekichhoat($username)
		{
			$sql = "UPDATE khachhang SET kh_trangthai = 1 WHERE kh_tendangnhap = '$username'";
			$this->setQuery($sql);
			return $this->execute();
		}

		function sendGmail($username, $password, $name, $address, $subject, $content)
		{
			$mail = new PHPMailer(true);
			$mail->IsSMTP(); // thiet lap mailer de su dung SMTP
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth = true; //  bat chung thuc SMTP
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";// chi dinh server chinh va server phu
			$mail->Port = "465"; // thiet lap cong de su dung
			$mail->Username = $username;// username(dia chi mail)
			$mail->Password = $password; // password nguoi gui
			$mail->AddAddress($address);// dia chi nguoi nhan
			//$mail->AppReplyTo($replyTo);// mail duoc reply cho ai
			$mail->SetFrom($username, $name); // tu nguoi gui, ten nguoi gui
			$mail->Subject = $subject; // chu de thu
			$mail->MsgHTML($content);// noi dung thu
			$mail->Charset = 'UTF-8';
			$mail->Send();
		}
	}
?>