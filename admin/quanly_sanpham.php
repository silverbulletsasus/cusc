<?php include("header.php") ?>
<?php include("controller/c_sanpham.php") ?>
<?php 
	if(isset($_GET['masp']))
	{
		// xóa sản phẩm
		$masp = $_GET['masp'];
		$sanpham = new C_sanpham();
		$sanpham->deleteSP($masp);
	}
?>
	<div class="container">
		<div class="row">
			
				<h1>Danh Sách Sản Phẩm</h1>
				<div>
					<a href="quanly_sanpham_themmoi.php"><img src="public/images/add.png">Thêm mới sản phẩm</a>
				</div>
				<table id="datatable" class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Số Thứ Tự</th>
							<th>Mã Sản Phẩm</th>
							<th>Tên Sản Phẩm</th>
							<th>Giá</th>
							<th>Số Lượng</th>
							<th>Loại Sản Phẩm</th>
							<th>Nhà Sản Xuất</th>
							<th>Hình Ảnh</th>
							<th>Cập Nhật</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$c_sanpham = new C_sanpham();
							$result = $c_sanpham->hienthidanhsachSP();
							$stt = 1;
							for($i = 0; $i < count($result); $i++)
							{
						?>
							<tr>
								<td><?php echo $stt ?></td>
								<td><?php echo $result[$i]->sp_ma ?></td>
								<td><?php echo $result[$i]->sp_ten ?></td>
								<td><?php echo $result[$i]->sp_gia ?></td>
								<td><?php echo $result[$i]->sp_soluong ?></td>
								<td><?php echo $result[$i]->lsp_ten ?></td>
								<td><?php echo $result[$i]->nsx_ten ?></td>
								<td align='center'><a href="quanly_sanpham_hinhanh.php?masp=<?php echo $result[$i]->sp_ma ?>"><img src="public/images/image_edit.png"></a></td>
								<td align='center'><a href="quanly_sanpham_capnhat.php?masp=<?php echo $result[$i]->sp_ma ?>"><img src="public/images/edit.png"></a></td>
								<td align='center'><a href="?masp=<?php echo $result[$i]->sp_ma ?>" onclick="return deleteConfirm()"><img src="public/images/delete.png"></a></td>
							</tr>
						<?php
							$stt++;
							}
						?>
					</tbody>

				</table>
					
		</div>
	</div>
<?php include("footer.php") ?>
