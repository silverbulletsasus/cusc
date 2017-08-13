<?php
session_start();
	include("model/m_user.php");

	class C_user
	{
		function dangkyTK($username, $password, $repassword, $name, $email, $diachi, $dienthoai, $gioitinh, $ngaysinh)
		{
				$_SESSION['xuly'] = "";
				if($username == "" || $password == "" || $repassword == "" || $name == "" || $email == "" || $diachi == "" || $dienthoai == "" || $ngaysinh == "")
				{
					$_SESSION['xuly'] .= "Phải nhập đầy đủ các chỗ có dấu (*) <br>";
				}
				if($password != $repassword)
				{
					$_SESSION['xuly'] .= "Mật khẩu nhập lại không chính xác ! <br>";
				}
				if(strlen($password) <= 5)
				{
					$_SESSION['xuly'] .= "Mật khẩu phải nhiều hơn 5 kí tự ! <br>";
				}
				if($_SESSION['xuly'] == "")
				{
					$m_user = new M_user();
					$check = $m_user->kiemtratontai($username, $email);
					if($check)
					{
						echo "<div style='color:red; text-align:center'>Tên đăng nhập hoặc địa chỉ email đã tồn tại</div>";
					}
					else
					{
						$randomcode = md5(rand());
						$result = $m_user->dangky($username, $password, $name, $email, $diachi, $dienthoai, $gioitinh, $ngaysinh, $randomcode);
						if($result)
						{
							$noidungmail = "<p>Chúc mừng bạn $name đã đăng ký thành công tại website FreeForAll</p>".
							"<p>Vui lòng nhấn vào liên kết sau để kích hoạt: <a href='http://localhost/cusc/admin/activities.php/?taikhoan=$username&ma=$randomcode'></a></p>";
							$m_user->sendGmail('silverbullets001@gmail.com', 'taolapro', "Ban Quản Trị Web FreeForAll", $email, "Mail kích hoạt Website", $noidungmail);
							header('location:index.php');
							if(isset($_SESSION['error']))
							{
								unset($_SESSION['error']);
							}
						}
						else
						{
							$_SESSION['error'] = "Đăng kí không thành công";
							header('location:dangky.php');
						}
					}
				}
				else 
				{
					echo "<div style='color:red; text-align:center'>".$_SESSION['xuly']."</div>";
				}
		}

		function dangnhapTK($username, $md5_password)
		{
			if($username == "" || $md5_password == "")
			{
				echo "<div style='color:red; text-align:center'>Tên tài khoản và mật khẩu không được để trống!</div>";
			}
			else
			{
				$m_user = new M_user();
				$user = $m_user->dangnhap($username, $md5_password);
				if($user)
				{
					$_SESSION['kh_ten'] = $user->kh_ten;
					header('location:index.php');
					if(isset($_SESSION['kh_ten_error']))
					{
						unset($_SESSION['kh_ten_error']);
					}
				}
				else
				{
					$_SESSION['kh_ten_error'] = "Đăng nhập không thành công";
					header('location:dangnhap.php');
				}
			}
		}

		// kiểm tra tên tài khoản và ma kich hoat có tồn tại trước khi đăng kí
		function kiemtratontaiTK($username, $makichhoat)
		{
			$m_user = new M_user();
			return $m_user->kiemtratontai($username, $makichhoat);

		}
		// update kh_kichhoat = 1 sau khi khach hang da nhap vao link kich hoat
		function updatekichhoatTK($username)
		{
			$m_user = new M_user();
			return $m_user->updatekichhoat($username); 
		}
	}
 
?>