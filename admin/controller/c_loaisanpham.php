<?php
	include("model/m_loaisanpham.php");
	class C_loaisanpham
	{
		// hiểm thị danh sách loại sản phẩm
		function showLSP()
		{
			$m_loaisanpham = new M_loaisanpham(); 
			return $m_loaisanpham->show();
		}

		// thêm loại sản phẩm
		function addLSP($tenloaisp, $motaloaisp)
		{
			if($tenloaisp != "")
			{
				$m_loaisanpham = new M_loaisanpham();
				$result = $m_loaisanpham->kiemtratontai_ten($tenloaisp);
				if(!$result)
				{
					$ketqua = $m_loaisanpham->add($tenloaisp, $motaloaisp);
					if($ketqua)
					{
						header('location: quanly_loaisanpham.php');
					}
					else
					{
						echo "<div style='color:red; text-align:center'>Không thể thêm dữ liệu vào database</div>"; 
					}
				}
				else
				{
					echo "<div style='color:red; text-align:center'>Tên loại sản phẩm đã tồn tại</div>"; 
				}
			}
			else
			{
				echo "<div style='color:red; text-align:center'>Tên loại sản phẩm không được để trống</div>"; 
			}
		}

		// lấy dữ liệu từ database
		function getdataLSP($maloaisp)
		{
			$m_loaisanpham = new M_loaisanpham();
			$result = $m_loaisanpham->kiemtratontai_ma($maloaisp);
			if($result)
			{
				return $m_loaisanpham->getdata($maloaisp);
			}
			else
			{
				echo "<div style='color:red; text-align:center'>Loại sản phẩm không tồn tại</div>";
			}
		}

		//cập nhật dữ liệu
		function updateLSP($maloaisp, $tenloaisp, $motaloaisp)
		{
			if($tenloaisp != "")
			{
				$m_loaisanpham = new M_loaisanpham();
				$result = $m_loaisanpham->kiemtratontai_ma($maloaisp);
				if($result)
				{
					$check = $m_loaisanpham->update($maloaisp, $tenloaisp, $motaloaisp);
					if($check)
					{
						header('location: quanly_loaisanpham.php');
					}
					else
					{
						echo "<div style='color:red; text-align:center'>Không update được loại sản phẩm</div>";
					}
				}
				else
				{
					echo "<div style='color:red; text-align:center'>Loại sản phẩm không tồn tại</div>";
				}
			}
			else
			{
				echo "<div style='color:red; text-align:center'>Tên loại sản phẩm không được để trống</div>";
			}
		}

		// delete loai san pham
		function deleteLSP($maloaisp)
		{
			$m_loaisanpham = new M_loaisanpham();
			$check = $m_loaisanpham->kiemtratontai_ma($maloaisp);
			if($check)
			{
				$result = $m_loaisanpham->delete($maloaisp);
				if($result)
				{
					header('location: quanly_loaisanpham.php');
				}
				else
				{
					echo "<div style='color:red; text-align:center'>Không delete được loại sản phẩm</div>";
				}
			}
			else
			{
				echo "<div style='color:red; text-align:center'>Loại sản phẩm không tồn tại</div>";
			}
		}

	}
?>