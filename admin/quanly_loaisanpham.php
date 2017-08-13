<?php include("header.php") ?>
<?php include("controller/c_loaisanpham.php") ?>
<?php
	// xoá dữ liệu
	if(isset($_GET['lsp_ma']))
	{
		$lsp_ma = $_GET['lsp_ma'];
		$loaisanpham = new M_loaisanpham();
		$loaisanpham->delete($lsp_ma);
	}
?>
	<div class="container">
		<div class="row">
			
				<h1>Danh Sách Loại Sản Phẩm</h1>
				<div>
					<a href="quanly_loaisanpham_themmoi.php"><img src="public/images/add.png">Thêm mới loại sản phẩm</a>
				</div>
				<br>
				<table id="datatable" class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Mã Loại Sản Phẩm</th>
							<th>Tên Loại Sản Phẩm</th>
							<th>Mô Tả</th>
							<th>Cập Nhật</th>
							<th>Xóa</th>
						</tr>
					</thead>
					<tbody>
						<?php
							// lấy dữ liệu từ database
							$c_loaisanpham = new C_loaisanpham();
							$result = $c_loaisanpham->showLSP();
							for($i = 0; $i < count($result); $i++)
							{

						?>
							<tr>
								<td><?php echo $result[$i]->lsp_ma ?></td>
								<td><?php echo $result[$i]->lsp_ten ?></td>
								<td><?php echo $result[$i]->lsp_mota ?></td>
								<td align='center'><a href="quanly_loaisanpham_capnhat.php?lsp_ma=<?php echo $result[$i]->lsp_ma ?>"><img src="public/images/edit.png"></a></td>
								<td align='center'><a href="?lsp_ma=<?php echo $result[$i]->lsp_ma ?>" onclick="return deleteConfirm() "><img src="public/images/delete.png"></a></td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>	
		</div>
	</div>
<?php include("footer.php") ?>